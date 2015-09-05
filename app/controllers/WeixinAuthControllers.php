<?php 

class WeixinAuthController extends BaseController{

	//获取code
	public function code()
	{
		$redirect_uri = "http://gift.zerioi.com/weixin/access";
		$scope = "snsapi_userinfo";
		$redirect_url = WeChatClient::getOAuthConnectUri($redirect_uri,'', $scope);
		return Redirect::to($redirect_url);
	}

	public function accessToken()
	{
		if(Session::get('code') == Input::get('code'))
		{
			Session::put('code', Input::get('code'));
		$code = Input::get('code');
		$weixin_data = WeChatClient::getAccessTokenByCode($code);
		var_dump($weixin_data);
		$access_token = $weixin_data['access_token'];
		$refresh_token = $weixin_data['refresh_token'];
		$open_id 	= $weixin_data['openid'];
		$user = WeChatClient::getUserInfoByAuth($access_token, $open_id);
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