<?php

class HomeController extends BaseController {

	//收藏礼品
	public function collection()
	{
		if(!Sentry::check())
			return Response::json(array('errCode'=>1, 'message' => '请登录'));
		// Sentry::login(Sentry::findUserById(5), false);
		$gift_id 	= Input::get('gift_id');
		$gift_focus 	= DB::table('gift_focus')->where('user_id','=', Sentry::getUser()->id)
							->where('gift_id', '=', $gift_id)->get();
		if(count($gift_focus) == 1)
		{
			$gift_focus 	= DB::table('gift_focus')->where('user_id','=', Sentry::getUser()->id)
							->where('gift_id', '=', $gift_id);
			if(!$gift_focus->delete())
				return Response::json(array('errCode'=>2, 'message'=>'取消收藏失败！'));
			return Response::json(array('errCode'=>0, 'message'=>'取消收藏成功！'));
		}else{
			$gift_focus = New GiftFocus;
			$gift_focus->user_id = Sentry::getUser()->id;
			$gift_focus->gift_id = $gift_id;
			if(!$gift_focus->save())
				return Response::json(array('errCode'=>3, 'message'=>'收藏失败！'));
			return Response::json(array('errCode'=>0, 'message'=>'收藏成功！'));
		}
	}

	
}