<?php

namespace ctapu4ok\VkMessengerSdk\API\Actions;

use ctapu4ok\VkMessengerSdk\API\ActionInterface;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\Groups\AddressWorkInfoStatus;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\Groups\GroupAccess;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\Groups\GroupAgeLimits;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\Groups\GroupAudio;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\Groups\GroupDocs;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\Groups\GroupMarketCurrency;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\Groups\GroupPhotos;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\Groups\GroupRole;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\Groups\GroupSubject;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\Groups\GroupTopics;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\Groups\GroupVideo;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\Groups\GroupWall;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\Groups\GroupWiki;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\Groups\MarketState;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\GroupsAct;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\GroupsFilter;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\GroupsNameCase;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\GroupsSort;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\GroupsSubtype;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\GroupsTagColor;
use ctapu4ok\VkMessengerSdk\API\Actions\Enums\GroupsType;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiAccessGroupsException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiCallbackApiServersLimitException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiClientUpdateNeededException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiGroupChangeCreatorException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiGroupHostNeed2faException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiGroupInviteLinksNotValidException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiGroupNeed2faException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiGroupNotInClubException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiGroupTooManyAddressesException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiGroupTooManyOfficersException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiInvalidAddressException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiLimitsException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiMarketShopAlreadyDisabledException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiMarketShopAlreadyEnabledException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiNotFoundException;
use ctapu4ok\VkMessengerSdk\Exceptions\Api\VKApiParamGroupIdException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKApiException;
use ctapu4ok\VkMessengerSdk\Exceptions\VKClientException;
use ctapu4ok\VkMessengerSdk\Ips\Request;

class Groups implements ActionInterface
{
    /**
     * @param Request $request
     */
    private Request $request;


    /**
     * Groups constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    /**
     * 
     * @param array $params
     * - @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiAccessGroupsException Access to the groups list is denied due to the user's privacy settings
     * @throws VKApiNotFoundException Not found
     * @throws VKApiGroupTooManyAddressesException Too many addresses in club
     * @var integer group_id
     * - @var string title
     * - @var string address
     * - @var string additional_address
     * - @var integer city_id
     * - @var integer metro_id
     * - @var number latitude
     * - @var number longitude
     * - @var string phone
     * - @var AddressWorkInfoStatus work_info_status: Status of information about timetable
     * - @var string timetable
     * - @var boolean is_main_address
     */
    public function addAddress(array $params = []): mixed
    {
        return $this->request->post('groups.addAddress', $params);
    }


    /**
     * 
     * @param array $params
     * - @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiCallbackApiServersLimitException Servers number limit is reached
     * @var integer group_id
     * - @var string url
     * - @var string title
     * - @var string secret_key
     */
    public function addCallbackServer(array $params = [])
    {
        return $this->request->post('groups.addCallbackServer', $params);
    }


    /**
     * Allows to add a link to the community.
     *
     * 
     * @param array $params
     * - @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @var integer group_id: Community ID.
     * - @var string link: Link URL.
     * - @var string text: Description text for the link.
     */
    public function addLink(array $params = [])
    {
        return $this->request->post('groups.addLink', $params);
    }


    /**
     * Allows to approve join request to the community.
     *
     * 
     * @param array $params
     * - @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiLimitsException Out of limits
     * @var integer group_id: Community ID.
     * - @var integer user_id: User ID.
     */
    public function approveRequest(array $params = [])
    {
        return $this->request->post('groups.approveRequest', $params);
    }


    /**
     * 
     * @param array $params
     * - @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @var integer group_id
     * - @var integer owner_id
     * - @var integer end_date
     * - @var integer reason
     * - @var string comment
     * - @var boolean comment_visible
     */
    public function ban(array $params = [])
    {
        return $this->request->post('groups.ban', $params);
    }


    /**
     * Creates a new community.
     *
     * 
     * @param array $params
     * - @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiLimitsException Out of limits
     * @var string title: Community title.
     * - @var string description: Community description (ignored for 'type' = 'public').
     * - @var GroupsType type: Community type. Possible values: *'group' - group,, *'event' - event,, *'public' - public page
     * - @var integer public_category: Category ID (for 'type' = 'public' only).
     * - @var integer public_subcategory: Public page subcategory ID.
     * - @var GroupsSubtype subtype: Public page subtype. Possible values: *'1' - place or small business,, *'2' - company, organization or website,, *'3' - famous person or group of people,, *'4' - product or work of art.
     */
    public function create(array $params = [])
    {
        return $this->request->post('groups.create', $params);
    }


    /**
     * 
     * @param array $params
     * - 
     * @param array $params
     * - @return mixed
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiAccessGroupsException Access to the groups list is denied due to the user's privacy settings
     * @throws VKApiNotFoundException Not found
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiNotFoundException Not found
     * @var integer address_id
     * @var integer group_id
     * -/
     * public function deleteAddress(array $params = [])
     * {
     * return $this->request->post('groups.deleteAddress', $params);
     * }
     *
     *
     * /**
     * @var integer group_id
     * - @var integer server_id
     */
    public function deleteCallbackServer(array $params = [])
    {
        return $this->request->post('groups.deleteCallbackServer', $params);
    }


    /**
     * Allows to delete a link from the community.
     *
     * 
     * @param array $params
     * - 
     * @param array $params
     * - @return mixed
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKClientException
     * @throws VKApiException
     * @var integer link_id: Link ID.
     * @var integer group_id: Community ID.
     * -/
     * public function deleteLink(array $params = [])
     * {
     * return $this->request->post('groups.deleteLink', $params);
     * }
     *
     *
     * /**
     * @var integer group_id
     */
    public function disableOnline(array $params = [])
    {
        return $this->request->post('groups.disableOnline', $params);
    }


    /**
     * Edits a community.
     *
     * 
     * @param array $params
     * - @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiInvalidAddressException Invalid screen name
     * @var integer group_id: Community ID.
     * - @var string title: Community title.
     * - @var string description: Community description.
     * - @var string screen_name: Community screen name.
     * - @var GroupAccess access: Community type. Possible values: *'0' - open,, *'1' - closed,, *'2' - private.
     * - @var string website: Website that will be displayed in the community information field.
     * - @var GroupSubject subject: Community subject. Possible values: , *'1' - auto/moto,, *'2' - activity holidays,, *'3' - business,, *'4' - pets,, *'5' - health,, *'6' - dating and communication, , *'7' - games,, *'8' - IT (computers and software),, *'9' - cinema,, *'10' - beauty and fashion,, *'11' - cooking,, *'12' - art and culture,, *'13' - literature,, *'14' - mobile services and internet,, *'15' - music,, *'16' - science and technology,, *'17' - real estate,, *'18' - news and media,, *'19' - security,, *'20' - education,, *'21' - home and renovations,, *'22' - politics,, *'23' - food,, *'24' - industry,, *'25' - travel,, *'26' - work,, *'27' - entertainment,, *'28' - religion,, *'29' - family,, *'30' - sports,, *'31' - insurance,, *'32' - television,, *'33' - goods and services,, *'34' - hobbies,, *'35' - finance,, *'36' - photo,, *'37' - esoterics,, *'38' - electronics and appliances,, *'39' - erotic,, *'40' - humor,, *'41' - society, humanities,, *'42' - design and graphics.
     * - @var string email: Organizer email (for events).
     * - @var string phone: Organizer phone number (for events).
     * - @var string rss: RSS feed address for import (available only to communities with special permission. Contact vk.com/support to get it.
     * - @var integer event_start_date: Event start date in Unixtime format.
     * - @var integer event_finish_date: Event finish date in Unixtime format.
     * - @var integer event_group_id: Organizer community ID (for events only).
     * - @var integer public_category: Public page category ID.
     * - @var integer public_subcategory: Public page subcategory ID.
     * - @var string public_date: Founding date of a company or organization owning the community in "dd.mm.YYYY" format.
     * - @var GroupWall wall: Wall settings. Possible values: *'0' - disabled,, *'1' - open,, *'2' - limited (groups and events only),, *'3' - closed (groups and events only).
     * - @var GroupTopics topics: Board topics settings. Possbile values: , *'0' - disabled,, *'1' - open,, *'2' - limited (for groups and events only).
     * - @var GroupPhotos photos: Photos settings. Possible values: *'0' - disabled,, *'1' - open,, *'2' - limited (for groups and events only).
     * - @var GroupVideo video: Video settings. Possible values: *'0' - disabled,, *'1' - open,, *'2' - limited (for groups and events only).
     * - @var GroupAudio audio: Audio settings. Possible values: *'0' - disabled,, *'1' - open,, *'2' - limited (for groups and events only).
     * - @var boolean links: Links settings (for public pages only). Possible values: *'0' - disabled,, *'1' - enabled.
     * - @var boolean events: Events settings (for public pages only). Possible values: *'0' - disabled,, *'1' - enabled.
     * - @var boolean places: Places settings (for public pages only). Possible values: *'0' - disabled,, *'1' - enabled.
     * - @var boolean contacts: Contacts settings (for public pages only). Possible values: *'0' - disabled,, *'1' - enabled.
     * - @var GroupDocs docs: Documents settings. Possible values: *'0' - disabled,, *'1' - open,, *'2' - limited (for groups and events only).
     * - @var GroupWiki wiki: Wiki pages settings. Possible values: *'0' - disabled,, *'1' - open,, *'2' - limited (for groups and events only).
     * - @var boolean messages: Community messages. Possible values: *'0' - disabled,, *'1' - enabled.
     * - @var boolean articles
     * - @var boolean addresses
     * - @var GroupAgeLimits age_limits: Community age limits. Possible values: *'1' - no limits,, *'2' - 16+,, *'3' - 18+.
     * - @var boolean market: Market settings. Possible values: *'0' - disabled,, *'1' - enabled.
     * - @var boolean market_comments: market comments settings. Possible values: *'0' - disabled,, *'1' - enabled.
     * - @var array[integer] market_country: Market delivery countries.
     * - @var array[integer] market_city: Market delivery cities (if only one country is specified).
     * - @var GroupMarketCurrency market_currency: Market currency settings. Possbile values: , *'643' - Russian rubles,, *'980' - Ukrainian hryvnia,, *'398' - Kazakh tenge,, *'978' - Euro,, *'840' - US dollars
     * - @var integer market_contact: Seller contact for market. Set '0' for community messages.
     * - @var integer market_wiki: ID of a wiki page with market description.
     * - @var boolean obscene_filter: Obscene expressions filter in comments. Possible values: , *'0' - disabled,, *'1' - enabled.
     * - @var boolean obscene_stopwords: Stopwords filter in comments. Possible values: , *'0' - disabled,, *'1' - enabled.
     * - @var array[string] obscene_words: Keywords for stopwords filter.
     * - @var integer main_section
     * - @var integer secondary_section
     * - @var integer country: Country of the community.
     * - @var integer city: City of the community.
     */
    public function edit(array $params = [])
    {
        return $this->request->post('groups.edit', $params);
    }


    /**
     * 
     * @param array $params
     * - @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiAccessGroupsException Access to the groups list is denied due to the user's privacy settings
     * @throws VKApiNotFoundException Not found
     * @throws VKApiGroupTooManyAddressesException Too many addresses in club
     * @var integer group_id
     * - @var integer address_id
     * - @var string title
     * - @var string address
     * - @var string additional_address
     * - @var integer city_id
     * - @var integer metro_id
     * - @var number latitude
     * - @var number longitude
     * - @var string phone
     * - @var AddressWorkInfoStatus work_info_status: Status of information about timetable
     * - @var string timetable
     * - @var boolean is_main_address
     */
    public function editAddress(array $params = [])
    {
        return $this->request->post('groups.editAddress', $params);
    }


    /**
     * 
     * @param array $params
     * - @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiNotFoundException Not found
     * @var integer group_id
     * - @var integer server_id
     * - @var string url
     * - @var string title
     * - @var string secret_key
     */
    public function editCallbackServer(array $params = [])
    {
        return $this->request->post('groups.editCallbackServer', $params);
    }


    /**
     * Allows to edit a link in the community.
     *
     * 
     * @param array $params
     * - @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @var integer group_id: Community ID.
     * - @var integer link_id: Link ID.
     * - @var string text: New description text for the link.
     */
    public function editLink(array $params = [])
    {
        return $this->request->post('groups.editLink', $params);
    }


    /**
     * Allows to add, remove or edit the community manager.
     *
     * 
     * @param array $params
     * - @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiGroupChangeCreatorException Cannot edit creator role
     * @throws VKApiGroupNotInClubException User should be in club
     * @throws VKApiGroupTooManyOfficersException Too many officers in club
     * @throws VKApiGroupNeed2faException You need to enable 2FA for this action
     * @throws VKApiGroupHostNeed2faException User needs to enable 2FA for this action
     * @var integer group_id: Community ID.
     * - @var integer user_id: User ID.
     * - @var GroupRole role: Manager role. Possible values: *'moderator',, *'editor',, *'administrator',, *'advertiser'.
     * - @var boolean is_call_operator: '1' — allow the manager to accept community calls.
     * - @var boolean is_contact: '1' - to show the manager in Contacts block of the community.
     * - @var string contact_position: Position to show in Contacts block.
     * - @var string contact_phone: Contact phone.
     * - @var string contact_email: Contact e-mail.
     */
    public function editManager(array $params = [])
    {
        return $this->request->post('groups.editManager', $params);
    }


    /**
     * 
     * @param array $params
     * - @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @var integer group_id
     */
    public function enableOnline(array $params = [])
    {
        return $this->request->post('groups.enableOnline', $params);
    }


    /**
     * Returns a list of the communities to which a user belongs.
     *
     * 
     * @param array $params
     * - @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiAccessGroupsException Access to the groups list is denied due to the user's privacy settings
     * @var integer user_id: User ID.
     * - @var boolean extended: '1' - to return complete information about a user's communities, '0' - to return a list of community IDs without any additional fields (default),
     * - @var array[GroupsFilter] filter: Types of communities to return: 'admin' - to return communities administered by the user , 'editor' - to return communities where the user is an administrator or editor, 'moder' - to return communities where the user is an administrator, editor, or moderator, 'groups' - to return only groups, 'publics' - to return only public pages, 'events' - to return only events
     * - @var array[GroupsFields] fields: Profile fields to return.
     * - @var integer offset: Offset needed to return a specific subset of communities.
     * - @var integer count: Number of communities to return.
     */
    public function get(array $params = [])
    {
        return $this->request->post('groups.get', $params);
    }


    /**
     * Returns a list of community addresses.
     *
     * 
     * @param array $params
     * - @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiParamGroupIdException Invalid group id
     * @throws VKApiAccessGroupsException Access to the groups list is denied due to the user's privacy settings
     * @var integer group_id: ID or screen name of the community.
     * - @var array[integer] address_ids
     * - @var number latitude: Latitude of  the user geo position.
     * - @var number longitude: Longitude of the user geo position.
     * - @var integer offset: Offset needed to return a specific subset of community addresses.
     * - @var integer count: Number of community addresses to return.
     * - @var array[GroupsFields] fields: Address fields
     */
    public function getAddresses(array $params = [])
    {
        return $this->request->post('groups.getAddresses', $params);
    }


    /**
     * Returns a list of users on a community blacklist.
     *
     * 
     * @param array $params
     * - @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiNotFoundException Not found
     * @var integer group_id: Community ID.
     * - @var integer offset: Offset needed to return a specific subset of users.
     * - @var integer count: Number of users to return.
     * - @var array[GroupsFields] fields
     * - @var integer owner_id
     */
    public function getBanned(array $params = [])
    {
        return $this->request->post('groups.getBanned', $params);
    }


    /**
     * Returns information about communities by their IDs.
     *
     * 
     * @param array $params
     * - @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @var array[integer]|array[string] group_ids: IDs or screen names of communities.
     * - @var integer|string group_id: ID or screen name of the community.
     * - @var array[GroupsFields] fields: Group fields to return.
     */
    public function getById(array $params = [])
    {
        return $this->request->post('groups.getById', $params);
    }


    /**
     * Returns Callback API confirmation code for the community.
     *
     * 
     * @param array $params
     * - @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @var integer group_id: Community ID.
     */
    public function getCallbackConfirmationCode(array $params = [])
    {
        return $this->request->post('groups.getCallbackConfirmationCode', $params);
    }


    /**
     * 
     * @param array $params
     * - 
     * @param array $params
     * - @return mixed
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiNotFoundException Not found
     * @var array[integer] server_ids
     * @var integer group_id
     * -/
     * public function getCallbackServers(array $params = [])
     * {
     * return $this->request->post('groups.getCallbackServers', $params);
     * }
     *
     *
     * /**
     * Returns [vk.com/dev/callback_api|Callback API] notifications settings.
     *
     * @var integer group_id: Community ID.
     * - @var integer server_id: Server ID.
     */
    public function getCallbackSettings(array $params = [])
    {
        return $this->request->post('groups.getCallbackSettings', $params);
    }


    /**
     * Returns categories list for communities catalog
     *
     * 
     * @param array $params
     * - 
     * @param array $params
     * - @return mixed
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKClientException
     * @throws VKApiException
     * @var boolean subcategories: 1 - to return subcategories info. By default: 0.
     * @var boolean extended: 1 - to return communities count and three communities for preview. By default: 0.
     * -/
     * public function getCatalogInfo(array $params = [])
     * {
     * return $this->request->post('groups.getCatalogInfo', $params);
     * }
     *
     *
     * /**
     * Returns invited users list of a community
     *
     * @var integer group_id: Group ID to return invited users for.
     * - @var integer offset: Offset needed to return a specific subset of results.
     * - @var integer count: Number of results to return.
     * - @var array[GroupsFields] fields: List of additional fields to be returned. Available values: 'sex, bdate, city, country, photo_50, photo_100, photo_200_orig, photo_200, photo_400_orig, photo_max, photo_max_orig, online, online_mobile, lists, domain, has_mobile, contacts, connections, site, education, universities, schools, can_post, can_see_all_posts, can_see_audio, can_write_private_message, status, last_seen, common_count, relation, relatives, counters'.
     * - @var GroupsNameCase name_case: Case for declension of user name and surname. Possible values: *'nom' - nominative (default),, *'gen' - genitive,, *'dat' - dative,, *'acc' - accusative, , *'ins' - instrumental,, *'abl' - prepositional.
     */
    public function getInvitedUsers(array $params = [])
    {
        return $this->request->post('groups.getInvitedUsers', $params);
    }


    /**
     * Returns a list of invitations to join communities and events.
     *
     * 
     * @param array $params
     * - @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @var integer offset: Offset needed to return a specific subset of invitations.
     * - @var integer count: Number of invitations to return.
     * - @var boolean extended: '1' - to return additional [vk.com/dev/fields_groups|fields] for communities..
     */
    public function getInvites(array $params = [])
    {
        return $this->request->post('groups.getInvites', $params);
    }


    /**
     * Returns the data needed to query a Long Poll server for events
     *
     * 
     * @param array $params
     * - @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @var integer group_id: Community ID.
     */
    public function getLongPollServer(array $params = [])
    {
        return $this->request->post('groups.getLongPollServer', $params);
    }


    /**
     * Returns Long Poll notification settings
     *
     * 
     * @param array $params
     * - @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @var integer group_id: Community ID.
     */
    public function getLongPollSettings(array $params = [])
    {
        return $this->request->post('groups.getLongPollSettings', $params);
    }


    /**
     * Returns a list of community members.
     *
     * 
     * @param array $params
     * - @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiParamGroupIdException Invalid group id
     * @var integer|string group_id: ID or screen name of the community.
     * - @var GroupsSort sort: Sort order. Available values: 'id_asc', 'id_desc', 'time_asc', 'time_desc'. 'time_asc' and 'time_desc' are availavle only if the method is called by the group's 'moderator'.
     * - @var integer offset: Offset needed to return a specific subset of community members.
     * - @var integer count: Number of community members to return.
     * - @var array[GroupsFields] fields: List of additional fields to be returned. Available values: 'sex, bdate, city, country, photo_50, photo_100, photo_200_orig, photo_200, photo_400_orig, photo_max, photo_max_orig, online, online_mobile, lists, domain, has_mobile, contacts, connections, site, education, universities, schools, can_post, can_see_all_posts, can_see_audio, can_write_private_message, status, last_seen, common_count, relation, relatives, counters'.
     * - @var GroupsFilter filter: *'friends' - only friends in this community will be returned,, *'unsure' - only those who pressed 'I may attend' will be returned (if it's an event).
     */
    public function getMembers(array $params = [])
    {
        return $this->request->post('groups.getMembers', $params);
    }


    /**
     * 
     * @param array $params
     * - @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @var integer group_id
     */
    public function getOnlineStatus(array $params = [])
    {
        return $this->request->post('groups.getOnlineStatus', $params);
    }


    /**
     * Returns a list of requests to the community.
     *
     * 
     * @param array $params
     * - 
     * @param array $params
     * - @return mixed
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKClientException
     * @throws VKApiException
     * @var array[GroupsFields] fields: Profile fields to return.
     * @var integer group_id: Community ID.
     * - @var integer offset: Offset needed to return a specific subset of results.
     * - @var integer count: Number of results to return.
     * -/
     * public function getRequests(array $params = [])
     * {
     * return $this->request->post('groups.getRequests', $params);
     * }
     *
     *
     * /**
     * Returns community settings.
     *
     * @var integer|string group_id: Community ID.
     */
    public function getSettings(array $params = [])
    {
        return $this->request->post('groups.getSettings', $params);
    }


    /**
     * List of group's tags
     *
     * 
     * @param array $params
     * - @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @var integer group_id
     */
    public function getTagList(array $params = [])
    {
        return $this->request->post('groups.getTagList', $params);
    }


    /**
     * 
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     */
    public function getTokenPermissions(string $access_token)
    {
        return $this->request->post('groups.getTokenPermissions', $access_token);
    }


    /**
     * Allows to invite friends to the community.
     *
     * 
     * @param array $params
     * - @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiLimitsException Out of limits
     * @var integer group_id: Community ID.
     * - @var integer user_id: User ID.
     */
    public function invite(array $params = [])
    {
        return $this->request->post('groups.invite', $params);
    }


    /**
     * Returns information specifying whether a user is a member of a community.
     *
     * 
     * @param array $params
     * - 
     * @param array $params
     * - 
     * @param array $params
     * - @return mixed
     * @return mixed
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiLimitsException Out of limits
     * @throws VKApiGroupInviteLinksNotValidException Invite link is invalid - expired, deleted or not exists
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiClientUpdateNeededException Client update needed
     * @var boolean extended: '1' - to return an extended response with additional fields. By default: '0'.
     * @var integer|string group_id: ID or screen name of the community.
     * - @var integer user_id: User ID.
     * - @var array[integer] user_ids: User IDs.
     * -/
     * public function isMember(array $params = [])
     * {
     * return $this->request->post('groups.isMember', $params);
     * }
     *
     *
     * /**
     * With this method you can join the group or public page, and also confirm your participation in an event.
     *
     * @var string not_sure: Optional parameter which is taken into account when 'gid' belongs to the event: '1' - Perhaps I will attend, '0' - I will be there for sure (default), ,
     * @var integer group_id: ID or screen name of the community.
     * -/
     * public function join(array $params = [])
     * {
     * return $this->request->post('groups.join', $params);
     * }
     *
     *
     * /**
     * With this method you can leave a group, public page, or event.
     *
     * @var integer group_id: ID or screen name of the community.
     */
    public function leave(array $params = [])
    {
        return $this->request->post('groups.leave', $params);
    }


    /**
     * Removes a user from the community.
     *
     * 
     * @param array $params
     * - 
     * @param array $params
     * - @return mixed
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKClientException
     * @throws VKApiException
     * @var integer user_id: User ID.
     * @var integer group_id: Community ID.
     * -/
     * public function removeUser(array $params = [])
     * {
     * return $this->request->post('groups.removeUser', $params);
     * }
     *
     *
     * /**
     * Allows to reorder links in the community.
     *
     * @var integer group_id: Community ID.
     * - @var integer link_id: Link ID.
     * - @var integer after: ID of the link after which to place the link with 'link_id'.
     */
    public function reorderLink(array $params = [])
    {
        return $this->request->post('groups.reorderLink', $params);
    }


    /**
     * Returns a list of communities matching the search criteria.
     *
     * 
     * @param array $params
     * - @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @var string q: Search query string.
     * - @var GroupsType type: Community type. Possible values: 'group, page, event.'
     * - @var integer country_id: Country ID.
     * - @var integer city_id: City ID. If this parameter is transmitted, country_id is ignored.
     * - @var boolean future: '1' - to return only upcoming events. Works with the 'type' = 'event' only.
     * - @var boolean market: '1' - to return communities with enabled market only.
     * - @var GroupsSort sort: Sort order. Possible values: *'0' - default sorting (similar the full version of the site),, *'1' - by growth speed,, *'2'- by the "day attendance/members number" ratio,, *'3' - by the "Likes number/members number" ratio,, *'4' - by the "comments number/members number" ratio,, *'5' - by the "boards entries number/members number" ratio.
     * - @var integer offset: Offset needed to return a specific subset of results.
     * - @var integer count: Number of communities to return. "Note that you can not receive more than first thousand of results, regardless of 'count' and 'offset' values."
     */
    public function search(array $params = [])
    {
        return $this->request->post('groups.search', $params);
    }


    /**
     * Allow to set notifications settings for group.
     *
     * 
     * @param array $params
     * - @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiNotFoundException Not found
     * @var integer group_id: Community ID.
     * - @var integer server_id: Server ID.
     * - @var string api_version
     * - @var boolean message_new: A new incoming message has been received ('0' - disabled, '1' - enabled).
     * - @var boolean message_reply: A new outcoming message has been received ('0' - disabled, '1' - enabled).
     * - @var boolean message_allow: Allowed messages notifications ('0' - disabled, '1' - enabled).
     * - @var boolean message_edit
     * - @var boolean message_deny: Denied messages notifications ('0' - disabled, '1' - enabled).
     * - @var boolean message_typing_state
     * - @var boolean photo_new: New photos notifications ('0' - disabled, '1' - enabled).
     * - @var boolean audio_new: New audios notifications ('0' - disabled, '1' - enabled).
     * - @var boolean video_new: New videos notifications ('0' - disabled, '1' - enabled).
     * - @var boolean wall_reply_new: New wall replies notifications ('0' - disabled, '1' - enabled).
     * - @var boolean wall_reply_edit: Wall replies edited notifications ('0' - disabled, '1' - enabled).
     * - @var boolean wall_reply_delete: A wall comment has been deleted ('0' - disabled, '1' - enabled).
     * - @var boolean wall_reply_restore: A wall comment has been restored ('0' - disabled, '1' - enabled).
     * - @var boolean wall_post_new: New wall posts notifications ('0' - disabled, '1' - enabled).
     * - @var boolean wall_repost: New wall posts notifications ('0' - disabled, '1' - enabled).
     * - @var boolean board_post_new: New board posts notifications ('0' - disabled, '1' - enabled).
     * - @var boolean board_post_edit: Board posts edited notifications ('0' - disabled, '1' - enabled).
     * - @var boolean board_post_restore: Board posts restored notifications ('0' - disabled, '1' - enabled).
     * - @var boolean board_post_delete: Board posts deleted notifications ('0' - disabled, '1' - enabled).
     * - @var boolean photo_comment_new: New comment to photo notifications ('0' - disabled, '1' - enabled).
     * - @var boolean photo_comment_edit: A photo comment has been edited ('0' - disabled, '1' - enabled).
     * - @var boolean photo_comment_delete: A photo comment has been deleted ('0' - disabled, '1' - enabled).
     * - @var boolean photo_comment_restore: A photo comment has been restored ('0' - disabled, '1' - enabled).
     * - @var boolean video_comment_new: New comment to video notifications ('0' - disabled, '1' - enabled).
     * - @var boolean video_comment_edit: A video comment has been edited ('0' - disabled, '1' - enabled).
     * - @var boolean video_comment_delete: A video comment has been deleted ('0' - disabled, '1' - enabled).
     * - @var boolean video_comment_restore: A video comment has been restored ('0' - disabled, '1' - enabled).
     * - @var boolean market_comment_new: New comment to market item notifications ('0' - disabled, '1' - enabled).
     * - @var boolean market_comment_edit: A market comment has been edited ('0' - disabled, '1' - enabled).
     * - @var boolean market_comment_delete: A market comment has been deleted ('0' - disabled, '1' - enabled).
     * - @var boolean market_comment_restore: A market comment has been restored ('0' - disabled, '1' - enabled).
     * - @var boolean market_order_new
     * - @var boolean market_order_edit
     * - @var boolean poll_vote_new: A vote in a public poll has been added ('0' - disabled, '1' - enabled).
     * - @var boolean group_join: Joined community notifications ('0' - disabled, '1' - enabled).
     * - @var boolean group_leave: Left community notifications ('0' - disabled, '1' - enabled).
     * - @var boolean group_change_settings
     * - @var boolean group_change_photo
     * - @var boolean group_officers_edit
     * - @var boolean user_block: User added to community blacklist
     * - @var boolean user_unblock: User removed from community blacklist
     * - @var boolean lead_forms_new: New form in lead forms
     * - @var boolean like_add
     * - @var boolean like_remove
     * - @var boolean message_event
     * - @var boolean donut_subscription_create
     * - @var boolean donut_subscription_prolonged
     * - @var boolean donut_subscription_cancelled
     * - @var boolean donut_subscription_price_changed
     * - @var boolean donut_subscription_expired
     * - @var boolean donut_money_withdraw
     * - @var boolean donut_money_withdraw_error
     */
    public function setCallbackSettings(array $params = [])
    {
        return $this->request->post('groups.setCallbackSettings', $params);
    }


    /**
     * Sets Long Poll notification settings
     *
     * 
     * @param array $params
     * - @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @var integer group_id: Community ID.
     * - @var boolean enabled: Sets whether Long Poll is enabled ('0' - disabled, '1' - enabled).
     * - @var string api_version
     * - @var boolean message_new: A new incoming message has been received ('0' - disabled, '1' - enabled).
     * - @var boolean message_reply: A new outcoming message has been received ('0' - disabled, '1' - enabled).
     * - @var boolean message_allow: Allowed messages notifications ('0' - disabled, '1' - enabled).
     * - @var boolean message_deny: Denied messages notifications ('0' - disabled, '1' - enabled).
     * - @var boolean message_edit: A message has been edited ('0' - disabled, '1' - enabled).
     * - @var boolean message_typing_state
     * - @var boolean photo_new: New photos notifications ('0' - disabled, '1' - enabled).
     * - @var boolean audio_new: New audios notifications ('0' - disabled, '1' - enabled).
     * - @var boolean video_new: New videos notifications ('0' - disabled, '1' - enabled).
     * - @var boolean wall_reply_new: New wall replies notifications ('0' - disabled, '1' - enabled).
     * - @var boolean wall_reply_edit: Wall replies edited notifications ('0' - disabled, '1' - enabled).
     * - @var boolean wall_reply_delete: A wall comment has been deleted ('0' - disabled, '1' - enabled).
     * - @var boolean wall_reply_restore: A wall comment has been restored ('0' - disabled, '1' - enabled).
     * - @var boolean wall_post_new: New wall posts notifications ('0' - disabled, '1' - enabled).
     * - @var boolean wall_repost: New wall posts notifications ('0' - disabled, '1' - enabled).
     * - @var boolean board_post_new: New board posts notifications ('0' - disabled, '1' - enabled).
     * - @var boolean board_post_edit: Board posts edited notifications ('0' - disabled, '1' - enabled).
     * - @var boolean board_post_restore: Board posts restored notifications ('0' - disabled, '1' - enabled).
     * - @var boolean board_post_delete: Board posts deleted notifications ('0' - disabled, '1' - enabled).
     * - @var boolean photo_comment_new: New comment to photo notifications ('0' - disabled, '1' - enabled).
     * - @var boolean photo_comment_edit: A photo comment has been edited ('0' - disabled, '1' - enabled).
     * - @var boolean photo_comment_delete: A photo comment has been deleted ('0' - disabled, '1' - enabled).
     * - @var boolean photo_comment_restore: A photo comment has been restored ('0' - disabled, '1' - enabled).
     * - @var boolean video_comment_new: New comment to video notifications ('0' - disabled, '1' - enabled).
     * - @var boolean video_comment_edit: A video comment has been edited ('0' - disabled, '1' - enabled).
     * - @var boolean video_comment_delete: A video comment has been deleted ('0' - disabled, '1' - enabled).
     * - @var boolean video_comment_restore: A video comment has been restored ('0' - disabled, '1' - enabled).
     * - @var boolean market_comment_new: New comment to market item notifications ('0' - disabled, '1' - enabled).
     * - @var boolean market_comment_edit: A market comment has been edited ('0' - disabled, '1' - enabled).
     * - @var boolean market_comment_delete: A market comment has been deleted ('0' - disabled, '1' - enabled).
     * - @var boolean market_comment_restore: A market comment has been restored ('0' - disabled, '1' - enabled).
     * - @var boolean poll_vote_new: A vote in a public poll has been added ('0' - disabled, '1' - enabled).
     * - @var boolean group_join: Joined community notifications ('0' - disabled, '1' - enabled).
     * - @var boolean group_leave: Left community notifications ('0' - disabled, '1' - enabled).
     * - @var boolean group_change_settings
     * - @var boolean group_change_photo
     * - @var boolean group_officers_edit
     * - @var boolean user_block: User added to community blacklist
     * - @var boolean user_unblock: User removed from community blacklist
     * - @var boolean like_add
     * - @var boolean like_remove
     * - @var boolean message_event
     * - @var boolean donut_subscription_create
     * - @var boolean donut_subscription_prolonged
     * - @var boolean donut_subscription_cancelled
     * - @var boolean donut_subscription_price_changed
     * - @var boolean donut_subscription_expired
     * - @var boolean donut_money_withdraw
     * - @var boolean donut_money_withdraw_error
     */
    public function setLongPollSettings(array $params = [])
    {
        return $this->request->post('groups.setLongPollSettings', $params);
    }


    /**
     * 
     * @param array $params
     * - @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @var integer group_id
     * - @var boolean messages
     * - @var boolean bots_capabilities: By enabling bot abilities, you can send users messages with a customized keyboard attached as well as use other promotional abilities
     * - @var boolean bots_start_button: If this setting is enabled, users will see a Start button when they start a chat with your community for the first time
     * - @var boolean bots_add_to_chat: If this setting is enabled then users can add your community to a chat
     */
    public function setSettings(array $params = [])
    {
        return $this->request->post('groups.setSettings', $params);
    }


    /**
     * In order to save note about group participant
     *
     * 
     * @param array $params
     * - @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @var integer group_id
     * - @var integer user_id
     * - @var string note: Note body
     */
    public function setUserNote(array $params = [])
    {
        return $this->request->post('groups.setUserNote', $params);
    }


    /**
     * Add new group's tag
     *
     * 
     * @param array $params
     * - @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @var integer group_id
     * - @var string tag_name
     * - @var GroupsTagColor tag_color
     */
    public function tagAdd(array $params = [])
    {
        return $this->request->post('groups.tagAdd', $params);
    }


    /**
     * Bind or unbind group's tag to user
     *
     * 
     * @param array $params
     * - 
     * @param array $params
     * - 
     * @param array $params
     * - @return mixed
     * @return mixed
     * @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKClientException
     * @throws VKApiException
     * @var GroupsAct act: Describe the action
     * @var integer group_id
     * - @var integer tag_id
     * - @var integer user_id
     * -/
     * public function tagBind(array $params = [])
     * {
     * return $this->request->post('groups.tagBind', $params);
     * }
     *
     *
     * /**
     * Delete group's tag
     *
     * @var integer tag_id
     * @var integer group_id
     * -/
     * public function tagDelete(array $params = [])
     * {
     * return $this->request->post('groups.tagDelete', $params);
     * }
     *
     *
     * /**
     * Update group's tag
     *
     * @var integer group_id
     * - @var integer tag_id
     * - @var string tag_name
     */
    public function tagUpdate(array $params = [])
    {
        return $this->request->post('groups.tagUpdate', $params);
    }


    /**
     * 
     * @param array $params
     * - @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKApiMarketShopAlreadyEnabledException Market was already enabled in this group
     * @throws VKApiMarketShopAlreadyDisabledException Market was already disabled in this group
     * @var integer group_id
     * - @var MarketState state: Declares state if market is enabled in group.
     * - @var string ref
     */
    public function toggleMarket(array $params = [])
    {
        return $this->request->post('groups.toggleMarket', $params);
    }



    /**
     * 
     * @param array $params
     * - @return mixed
     * @throws VKClientException
     * @throws VKApiException
     * @var integer owner_id
     * @var integer group_id
     */
    public function unban(array $params = [])
    {
        return $this->request->post('groups.unban', $params);
    }
}

