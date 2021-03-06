<?php 

class WeixinAuthController extends BaseController{

	private $appid = 'wx53d41c309823961e';
	private $appsecret = '1be5ea03d99ab476e52d238886e8966a';
	
	private static function get($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        # curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

        if (!curl_exec($ch))
        {
            error_log(curl_error($ch));
            $data = '';
        }
        else
        {
            $data = curl_multi_getcontent($ch);
        }
        curl_close($ch);

        return $data;
    }


	//1、用户同意授权，获取code。
	public function getOAuthConnectUri($redirect_uri, $state = '', $scope = 'snsapi_base')
    {
        $redirect_uri = urlencode($redirect_uri);
        $url          = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$this->appid}&redirect_uri={$redirect_uri}&response_type=code&scope={$scope}&state={$state}#wechat_redirect";

        return $url;
    }
    //2、通过code换取网页授权access_token
     public function getAccessTokenByCode($code)
    {
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$this->appid}&secret={$this->appsecret}&code=$code&grant_type=authorization_code";
        $res = json_decode(self::get($url), TRUE);

        return $res;
    }
    //3.刷新access_token（如果需要）
    public function refreshAccessToken($refresh_token)
    {
        $url = "https://api.weixin.qq.com/sns/oauth2/refresh_token?appid={$this->appid}&grant_type=refresh_token&refresh_token=$refresh_token";
        $res = json_decode(self::get($url), TRUE);

        return $res;
    }
    //4.拉取用户信息(需scope为 snsapi_userinfo)
    public function getUserInfoByAuth($access_token, $openid, $lang = 'zh_CN')
    {
        $url = "https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid&lang=$lang";
        $res = json_decode(self::get($url), TRUE);

        return $res;
    }

	
	//获取code
	public function code()
	{
		$redirect_uri = "http://gift.zerioi.com/weixin/access";
		$scope = "snsapi_userinfo";
		$redirect_url = $this->getOAuthConnectUri($redirect_uri,'', $scope);
		return Redirect::to($redirect_url);
	}

	public function accessToken()
	{
		if(Session::get('code') == Input::get('code'))
		{
			Session::put('code', Input::get('code'));
	:	$code = Input::get('code');
		$weixin_data = $this->getAccessTokenByCode($code);
		var_dump($weixin_data);
		$access_token = $weixin_data['access_token'];
		$refresh_token = $weixin_data['refresh_token'];
		$open_id 	= $weixin_data['openid'];
		$user = $this->getUserInfoByAuth($access_token, $open_id);
//		$client_user = New User;
//		$client_user->username = $user['nickname'];
//		$client_user->save();	
		return Redirect::to('/');
		}
		Session::put('code',Input::get('code'));
//      $client_user = New User;
//		$client_user->username = $user['nickname'];
//	    $client_user->save();
		return Redirect::to('/');
	}
}
