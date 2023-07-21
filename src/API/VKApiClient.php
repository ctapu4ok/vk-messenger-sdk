<?php

namespace ctapu4ok\VkMessengerSdk\API;

use ctapu4ok\VkMessengerSdk\API\Actions\Account;
use ctapu4ok\VkMessengerSdk\API\Actions\Ads;
use ctapu4ok\VkMessengerSdk\API\Actions\Apps;
use ctapu4ok\VkMessengerSdk\API\Actions\AppWidgets;
use ctapu4ok\VkMessengerSdk\API\Actions\Asr;
use ctapu4ok\VkMessengerSdk\API\Actions\Auth;
use ctapu4ok\VkMessengerSdk\API\Actions\Board;
use ctapu4ok\VkMessengerSdk\API\Actions\Bugtracker;
use ctapu4ok\VkMessengerSdk\API\Actions\Calls;
use ctapu4ok\VkMessengerSdk\API\Actions\Database;
use ctapu4ok\VkMessengerSdk\API\Actions\Docs;
use ctapu4ok\VkMessengerSdk\API\Actions\Donut;
use ctapu4ok\VkMessengerSdk\API\Actions\DownloadedGames;
use ctapu4ok\VkMessengerSdk\API\Actions\Execute;
use ctapu4ok\VkMessengerSdk\API\Actions\Fave;
use ctapu4ok\VkMessengerSdk\API\Actions\Friends;
use ctapu4ok\VkMessengerSdk\API\Actions\Gifts;
use ctapu4ok\VkMessengerSdk\API\Actions\Groups;
use ctapu4ok\VkMessengerSdk\API\Actions\LeadForms;
use ctapu4ok\VkMessengerSdk\API\Actions\Leads;
use ctapu4ok\VkMessengerSdk\API\Actions\Likes;
use ctapu4ok\VkMessengerSdk\API\Actions\Market;
use ctapu4ok\VkMessengerSdk\API\Actions\Messages;
use ctapu4ok\VkMessengerSdk\API\Actions\Newsfeed;
use ctapu4ok\VkMessengerSdk\API\Actions\Notes;
use ctapu4ok\VkMessengerSdk\API\Actions\Notifications;
use ctapu4ok\VkMessengerSdk\API\Actions\Orders;
use ctapu4ok\VkMessengerSdk\API\Actions\Pages;
use ctapu4ok\VkMessengerSdk\API\Actions\Photos;
use ctapu4ok\VkMessengerSdk\API\Actions\Podcasts;
use ctapu4ok\VkMessengerSdk\API\Actions\Polls;
use ctapu4ok\VkMessengerSdk\API\Actions\PrettyCards;
use ctapu4ok\VkMessengerSdk\API\Actions\Search;
use ctapu4ok\VkMessengerSdk\API\Actions\Secure;
use ctapu4ok\VkMessengerSdk\API\Actions\Stats;
use ctapu4ok\VkMessengerSdk\API\Actions\Status;
use ctapu4ok\VkMessengerSdk\API\Actions\Storage;
use ctapu4ok\VkMessengerSdk\API\Actions\Store;
use ctapu4ok\VkMessengerSdk\API\Actions\Stories;
use ctapu4ok\VkMessengerSdk\API\Actions\Streaming;
use ctapu4ok\VkMessengerSdk\API\Actions\Users;
use ctapu4ok\VkMessengerSdk\API\Actions\Utils;
use ctapu4ok\VkMessengerSdk\API\Actions\Video;
use ctapu4ok\VkMessengerSdk\API\Actions\Wall;
use ctapu4ok\VkMessengerSdk\API\Actions\Widgets;
use ctapu4ok\VkMessengerSdk\Ips\Request;
use ctapu4ok\VkMessengerSdk\Settings;

/**
 * @method Account account()
 * @method Ads ads()
 * @method Apps apps()
 * @method AppWidgets appWidgets()
 * @method Asr asr()
 * @method Auth auth()
 * @method Board board()
 * @method Bugtracker bugtracker()
 * @method Calls calls()
 * @method Database database()
 * @method Docs docs()
 * @method Donut donut()
 * @method DownloadedGames downloadedGames()
 * @method Execute execute()
 * @method Fave fave()
 * @method Friends friends()
 * @method Gifts gifts()
 * @method Groups groups()
 * @method LeadForms leadForms()
 * @method Leads leads()
 * @method Likes likes()
 * @method Market market()
 * @method Messages messages()
 * @method Newsfeed newsfeed()
 * @method Notes notes()
 * @method Notifications notifications()
 * @method Orders orders()
 * @method Pages pages()
 * @method Photos photos()
 * @method Podcasts podcasts()
 * @method Polls polls()
 * @method PrettyCards prettyCards()
 * @method Search search()
 * @method Secure secure()
 * @method Stats stats()
 * @method Status status()
 * @method Storage storage()
 * @method Store store()
 * @method Stories stories()
 * @method Streaming streaming()
 * @method Users users()
 * @method Utils utils()
 * @method Video video()
 * @method Wall wall()
 * @method Widgets widgets()
 */
class VKApiClient
{
    protected const VK_API_ENDPOINT = 'https://api.vk.com/method';

    private Request $request;

    private array $instances = [];

    public function __construct(Settings $settings)
    {

        $this->request = new Request(
            $settings->getAppInfo()->getApiVersion(),
            self::VK_API_ENDPOINT,
            $language = '',
            $settings
        );
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * @param string $name
     * @param array $_
     * @return mixed
     * @throws \Exception
     */
    public function __call(string $name, array $_)
    {
        $name = strtolower($name);
        $class = __NAMESPACE__ . "\\Actions\\" . ucfirst($name);
        if (!class_exists($class)) {
            throw new \Exception("Class " . $class . " not found");
        }

        if (!array_key_exists($name, $this->instances)) {
            $this->instances[$name] = new $class($this->request);
        }

        return $this->instances[$name];
    }
}
