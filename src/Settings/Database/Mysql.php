<?php declare(strict_types=1);

namespace ctapu4ok\VkMessengerSdk\Settings\Database;

use Amp\CompositeException;
use Amp\Mysql\MysqlConfig;
use Amp\Mysql\MysqlConnectionPool;
use Amp\Mysql\MysqlResult;
use Amp\Mysql\MysqlStatement;
use Amp\Mysql\MysqlTransaction;
use Amp\Sql\ConnectionException;
use Amp\Sql\TransactionIsolation;
use Amp\Sql\TransactionIsolationLevel;
use ctapu4ok\VkMessengerSdk\Exceptions\Exception;
use ctapu4ok\VkMessengerSdk\Interfaces\DatabaseInterface;
use ctapu4ok\VkMessengerSdk\Logger;
use function Amp\async;
use function Amp\Future\await;

final class Mysql extends SqlDriverAbstract
{
    /**
     * @var MysqlStatement $statement
     */
    private $statement;
    /**
     * @var MysqlResult $results
     */
    private $results;
    private ?MysqlConnectionPool $connectionPool = null;
    public function __construct(?DatabaseInterface $settings = null)
    {
        if (empty($this->connectionPool)) {
            if (!empty($settings)) {
                $format = vsprintf(
                    "host=%s user=%s password=%s db=%s",
                    [
                        $settings->getUri(),
                        $settings->getUsername(),
                        $settings->getPassword(),
                        $settings->getDatabase()
                    ]
                );
                $config = MysqlConfig::fromString($format);
                $this->connectionPool = new MysqlConnectionPool($config);
            }
        }
    }

    public function prepare(string $sql)
    {
        $this->statement = $this->connectionPool->prepare($sql);

        return $this;
    }

    public function execute($sql = null, array $params = []): array|MysqlResult
    {
        if (empty($sql)) {
            $sql = $this->statement->getQuery();
        }
        try {
            $this->results = $this->connectionPool->execute($sql, $params);
        } catch (CompositeException $exception) {
            Logger::log($exception->getReasons(), Logger::LEVEL_NOTICE);
        } catch (ConnectionException $exception) {
            Logger::log([$exception->getMessage(), $exception->getTraceAsString()], Logger::LEVEL_ERROR);
        }

        return $this->results;
    }

    /**
     * Changes return type to this library's Transaction type.
     */
    public function beginTransaction(
        TransactionIsolation $isolation = TransactionIsolationLevel::Committed
    ): MysqlTransaction {
        return $this->connectionPool->beginTransaction($isolation);
    }

    public function __destruct()
    {
        if (!empty($this->connectionPool)) {
            $this->connectionPool->close();
            $this->connectionPool = null;
            $this->results = null;
            $this->statement = null;
        }
    }
}
