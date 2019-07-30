<?php
namespace Chocorail;

class ShopPages
{
    protected $chocorail;

    public function __construct(Chocorail $chocorail)
    {
        $this->chocorail = $chocorail;
    }

    public function getGirls($params = [])
    {
        $result = $this->chocorail->get("/shoppages/girls", $params);
        return $result;
    }

    public function getGirl($id, $params = [])
    {
        $result = $this->chocorail->get("/shoppages/girls/{$id}", $params);
        return $result;
    }

    public function getGirlAttendanceTimesToday($params = [])
    {
        $result = $this->chocorail->get("/shoppages/girlattendancetimes/today", $params);
        return $result;
    }

    public function getGirlAttendanceTimes($params = [])
    {
        $result = $this->chocorail->get("/shoppages/girlattendancetimes", $params);
        return $result;
    }

    public function getGirlBlogs($params = [])
    {
        $result = $this->chocorail->get("/shoppages/girlblogs", $params);
        return $result;
    }

    public function getGirlBlog($girlblogid)
    {
        $result = $this->chocorail->get("/shoppages/girlblogs/{$girlblogid}");
        return $result;
    }

    public function getGirlBlogPosts($girlblogid, $params = [])
    {
        $result = $this->chocorail->get("/shoppages/girlblogs/{$girlblogid}/posts", $params);
        return $result;
    }

    public function getGirlBlogPost($girlblogid, $girlblogpostid)
    {
        $result = $this->chocorail->get("/shoppages/girlblogs/{$girlblogid}/posts/{$girlblogpostid}");
        return $result;
    }

    public function getGirlTagLists($params = [])
    {
        $result = $this->chocorail->get("/shoppages/girltaglists", $params);
        return $result;
    }

    public function getGirlTagList($girltaglistid)
    {
        $result = $this->chocorail->get("/shoppages/girltaglists/{$girltaglistid}");
        return $result;
    }

    public function getGirlTagListTags($girltaglistid, $params = [])
    {
        $result = $this->chocorail->get("/shoppages/girltaglists/{$girltaglistid}/tags", $params);
        return $result;
    }

    public function getGirlTagListTag($girltaglistid, $girltagid)
    {
        $result = $this->chocorail->get("/shoppages/girltaglists/{$girltaglistid}/tags/{$girltagid}");
        return $result;
    }

    public function getGirlQandas($params = [])
    {
        $result = $this->chocorail->get("/shoppages/girlqandas", $params);
        return $result;
    }

    public function getGirlServiceLists($params = [])
    {
        $result = $this->chocorail->get("/shoppages/girlservicelists", $params);
        return $result;
    }

    public function getGirlServiceList($girlservicelistid)
    {
        $result = $this->chocorail->get("/shoppages/girlservicelists/{$girlservicelistid}");
        return $result;
    }

    public function getGirlServiceListServices($girlservicelistid, $params = [])
    {
        $result = $this->chocorail->get("/shoppages/girlservicelists/{$girlservicelistid}/services", $params);
        return $result;
    }

    public function getGirlServiceListService($girlservicelistid, $girlserviceid)
    {
        $result = $this->chocorail->get("/shoppages/girlservicelists/{$girlservicelistid}/services/{$girlserviceid}");
        return $result;
    }

    public function getNews($params = [])
    {
        $result = $this->chocorail->get("/shoppages/news", $params);
        return $result;
    }

    public function getNewsSingle($newsid)
    {
        $result = $this->chocorail->get("/shoppages/news/{$newsid}");
        return $result;
    }

    public function getNewsPosts($newsid, $params = [])
    {
        $result = $this->chocorail->get("/shoppages/news/{$newsid}/posts", $params);
        return $result;
    }

    public function getNewsPost($newsid, $newspostid)
    {
        $result = $this->chocorail->get("/shoppages/news/{$newsid}/posts/{$newspostid}");
        return $result;
    }

    public function getSnippets($params = [])
    {
        $result = $this->chocorail->get("/shoppages/snippets", $params);
        return $result;
    }

    public function getSnippet($snippetid)
    {
        $result = $this->chocorail->get("/shoppages/snippets/{$snippetid}");
        return $result;
    }

    public function getSnippetEntries($snippetid, $params = [])
    {
        $result = $this->chocorail->get("/shoppages/snippets/{$snippetid}/entries", $params);
        return $result;
    }

    public function getSnippetEntry($snippetid, $snippetEntryId, $params = [])
    {
        $result = $this->chocorail->get("/shoppages/snippets/{$snippetid}/entries/{$snippetEntryId}", $params);
        return $result;
    }

    public function getGirlRankings($params = [])
    {
        $result = $this->chocorail->get("/shoppages/girlrankings", $params);
        return $result;
    }

    public function getGirlRanking($rankingid)
    {
        $result = $this->chocorail->get("/shoppages/girlrankings/{$rankingid}");
        return $result;
    }

    public function getGirlRankingEntries($rankingid, $params = [])
    {
        $result = $this->chocorail->get("/shoppages/girlrankings/{$rankingid}/entries", $params);
        return $result;
    }

    public function getLinkLists($params = [])
    {
        $result = $this->chocorail->get("/shoppages/linklists", $params);
        return $result;
    }

    public function getLinkList($linklistid)
    {
        $result = $this->chocorail->get("/shoppages/linklists/{$linklistid}");
        return $result;
    }

    public function getLinkListLinks($linklistid, $params = [])
    {
        $result = $this->chocorail->get("/shoppages/linklists/{$linklistid}/links", $params);
        return $result;
    }

    public function getLinkListLink($linklistid, $linkid)
    {
        $result = $this->chocorail->get("/shoppages/linklists/{$linklistid}/links/{$linkid}");
        return $result;
    }

    public function sendMail(array $tos, string $subject, string $bodyHtml, string $bodyText = null, 
        array $ccs = array(), array $bccs = array())
    {
        $params = [
            'subject' => $subject,
            'bodyHtml' => $bodyHtml,
            'bodyText' => $bodyText,
        ];
        for ($i=0; $i < count($tos); $i++) { 
            $params['to['.$i.']'] = $tos[$i];
        }
        for ($i=0; $i < count($ccs); $i++) { 
            $params['cc['.$i.']'] = $ccs[$i];
        }
        for ($i=0; $i < count($bccs); $i++) { 
            $params['bcc['.$i.']'] = $bccs[$i];
        }
        if (isset($additional_headers)) {
            $params = array_merge($params, $additional_headers);
        }
        $result = $this->chocorail->post("/shoppages/mail/send", $params, 'multipart/form-data');
        return $result;
    }

    public function isValidUserToken(string $memberID, string $userToken)
    {
        try {
            $res = $this->validateUserToken($memberID, $userToken);
            if ($res->isSuccess()) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    public function validateUserToken(string $memberID, string $userToken)
    {
        $params = [
            'userToken' => $userToken,
        ];
        $result = $this->chocorail->post("/shoppages/members/{$memberID}/validateusertoken", $params);
        return $result;
    }

    public function getMembers($params = [])
    {
        $result = $this->chocorail->get("/shoppages/members", $params);
        return $result;
    }

    public function getMember($id, $params = [])
    {
        $result = $this->chocorail->get("/shoppages/members/{$id}", $params);
        return $result;
    }

    public function getMemberTags($memberid, $params = [])
    {
        $result = $this->chocorail->get("/shoppages/members/{$memberid}/tags", $params);
        return $result;
    }

    public function addMemberTags($memberid, $tagids, $params = [])
    {
        $params['tagids'] = $tagids;
        $result = $this->chocorail->post("/shoppages/members/{$memberid}/tags", $params);
        return $result;
    }

    public function updateMemberTags($memberid, $tagids, $params = [])
    {
        $params['tagids'] = $tagids;
        $result = $this->chocorail->put("/shoppages/members/{$memberid}/tags", $params);
        return $result;
    }

    public function removeMemberTags($memberid, $tagids, $params = [])
    {
        $params['tagids'] = $tagids;
        $result = $this->chocorail->delete("/shoppages/members/{$memberid}/tags", $params);
        return $result;
    }

    public function getMemberTagLists($params = [])
    {
        $result = $this->chocorail->get("/shoppages/membertaglists", $params);
        return $result;
    }

    public function getMemberTagList($membertaglistid)
    {
        $result = $this->chocorail->get("/shoppages/membertaglists/{$membertaglistid}");
        return $result;
    }

    public function getMemberTagListTags($membertaglistid, $params = [])
    {
        $result = $this->chocorail->get("/shoppages/membertaglists/{$membertaglistid}/tags", $params);
        return $result;
    }

    public function getMemberTagListTag($membertaglistid, $membertagid)
    {
        $result = $this->chocorail->get("/shoppages/membertaglists/{$membertaglistid}/tags/{$membertagid}");
        return $result;
    }

    public function addMember($params = [])
    {
        $result = $this->chocorail->post("/shoppages/members", $params);
        return $result;
    }

    public function verifyEmail(string $memberID, string $confirmToken)
    {
        $params = [
            'confirmToken' => $confirmToken,
        ];
        $result = $this->chocorail->post("/shoppages/members/{$memberID}/verifyemail", $params);
        return $result;
    }

    public function updateMember(string $memberID, array $params = [])
    {
        $result = $this->chocorail->put("/shoppages/members/{$memberID}", $params);
        return $result;
    }

    public function cancelMember(string $memberID, string $userToken)
    {
        $params = [
            'userToken' => $userToken,
        ];
        $result = $this->chocorail->post("/shoppages/members/{$memberID}/cancel", $params);
        return $result;
    }

    public function subscribeNewsletter(string $memberID, string $userToken)
    {
        $params = [
            'userToken' => $userToken,
        ];
        $result = $this->chocorail->post("/shoppages/members/{$memberID}/subscribenewsletter", $params);
        return $result;
    }

    public function unsubscribeNewsletter(string $memberID, string $userToken, string $newsletterID = null)
    {
        $params = [
            'userToken' => $userToken,
            'newsletterID' => $newsletterID,
        ];
        $result = $this->chocorail->post("/shoppages/members/{$memberID}/unsubscribenewsletter", $params);
        return $result;
    }

    public function unsubscribedReason(string $memberID, string $userToken, string $reason, string $reasonDetail = null)
    {
        $params = [
            'userToken' => $userToken,
            'reason' => $reason,
            'reasonDetail' => $reasonDetail,
        ];
        $result = $this->chocorail->post("/shoppages/members/{$memberID}/unsubscribedreason", $params);
        return $result;
    }

    public function requestChangeEmail(string $memberID, string $userToken, string $newEmail)
    {
        $params = [
            'userToken' => $userToken,
            'newEmail' => $newEmail,
        ];
        $result = $this->chocorail->post("/shoppages/members/{$memberID}/requestchangeemail", $params);
        return $result;
    }

    public function confirmChangeEmail(string $memberID, string $confirmToken, string $newEmail)
    {
        $newEmailDecoded = base64_decode(strtr($newEmail, '-_', '+/'), true);
        $params = [
            'confirmToken' => $confirmToken,
            'newEmail' => $newEmailDecoded,
        ];
        $result = $this->chocorail->post("/shoppages/members/{$memberID}/confirmchangeemail", $params);
        return $result;
    }

    public function changePassword(string $memberID, string $userToken, string $currentPassword, string $newPassword)
    {
        $params = [
            'userToken' => $userToken,
            'currentPassword' => $currentPassword,
            'newPassword' => $newPassword,
        ];
        $result = $this->chocorail->post("/shoppages/members/{$memberID}/changepassword", $params);
        return $result;
    }

    public function requestResetPassword(string $email)
    {
        $params = [
            'email' => $email,
        ];
        $result = $this->chocorail->post("/shoppages/members/requestresetpassword", $params);
        return $result;
    }

    public function confirmResetPassword(string $memberID, string $confirmToken, string $newPassword)
    {
        $params = [
            'confirmToken' => $confirmToken,
            'newPassword' => $newPassword,
        ];
        $result = $this->chocorail->post("/shoppages/members/{$memberID}/confirmresetpassword", $params);
        return $result;
    }
}
