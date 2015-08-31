<?php

class NoticeController extends BaseController{

	//回复条数
	public function notice()
	{
		if(! Sentry::check())
			return Response::json(array('errCode'=>1, 'message'=>'请登录'));
		$user = Sentry::getUser();
		//没有查看的评论条数和回复条数
		$join_coms = ArticleJoinCom::where('receiver','=',$user->id)
						->where('status','=',0)
						->where('is_delete','=',0)
						->get();
		$com_count = count($join_coms);
		$replys = ArticleJoinReply::where('receiver','=',$user->id)
						->where('status','=',0)
						->where('is_delete','=',0)
						->get();
		$reply_count = count($replys);
		$count = ($com_count + $reply_count);
		return Response::json(array('errCode'=>0, 'message'=>'返回评论条数和回复条数',
				'count' => $count,
			));
	}

	//话题回复的简讯页—显示头像和昵称
	public function brefNew()
	{
		if(! Sentry::check())
			return Response::json(array('errCode'=>1, 'message'=>'请登录'));
		$user = Sentry::getUser();

		$join_coms = ArticleJoinCom::where('receiver','=',$user->id)
						->where('status','=',0)
						->where('is_delete','=',0)
						->orderBy('created_at','desc')
						->get();
		if( count($join_coms)!=0 )
		{	
			foreach( $join_coms as $com)
			{
				$sender = User::find($com->sender_id);
				$com->avatar = $sender->avatar;
				$com->username = $sender->username;				
			}
		}
		$replys = ArticleJoinReply::where('receiver','=',$user->id)
						->where('status','=',0)
						->where('is_delete','=',0)
						->orderBy('created_at','desc')
						->get();
		if(count($replys) !=0 )
		{
			if( $replys as $reply)
			{
				$reply_sender = 
			}
		}

	//回到参与评论页面
	public function joinCom()
	{
		

	}
		}

}