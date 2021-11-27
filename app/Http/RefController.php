<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class RefController extends Controller {

	public function Ref(Request $request) {
		
		$admin = $this->user->is_admin;
		$moderator = $this->user->is_moderator;
		$name = $this->user->username;
		$users = $this->user->id;
		$ref = $this->user->ref;
		$ref_url = $this->user->ref_url;
		$ref_bonus = $this->user->ref_bonus;
		$bonus_ref = 5;							//кол-во денег, которое получит РЕФЕРЕР
		$bonus_user = 10;						//кол-во денег, которое получит РЕФЕРАЛ
		$balance = $this->user->money;
		$date_refers = date("Y-m-d H:i:s");

		
		if ($ref == 0) { $refers = \DB::table('users')->whereNull('ref_url_bonus', $ref_url)->orderBy('date_ref')->get(); }
		else { $refers = \DB::table('users')->where('ref_url_bonus', $ref_url)->Where('username', '<>', $name)->orderBy('date_ref')->get(); }
		
		if (isset($_POST['submit']) && $ref == 0)
		{
			if (isset($_POST['title'])) { $title = $_POST['title']; if ($title =='') { unset($title); } }
			
			$title = stripslashes($title); $title = htmlspecialchars($title);	
			
			$uid_get = \DB::table('users')->where('ref_get', $title)->pluck('ref_get');
			
			if($uid_get != $title) {
				
				\DB::table('users')
				->where('id', $users)
				->update(array('ref' => 1, 'ref_url' => $title, 'ref_get' => $title));	
			}
			else { return response()->json([ 'errors' => 'Такой код уже существует!']); 
			}
			
			return response()->json(['succes'=>'Код успешно создан!']);
			
			header('refresh: 0.1');
		}

		if (isset($_POST['refer']) && $ref_bonus == 0)
		{
			if (isset($_POST['title'])) { $title = $_POST['title']; if ($title =='') { unset($title); } }
			
			$title = stripslashes($title); $title = htmlspecialchars($title);	
			
			$uid_get = \DB::table('users')->where('ref_get', $title)->pluck('ref_get');
			
			
			$uid_refer = \DB::table('users')->where('ref_get', $title)->pluck('id');	
			$uid_refer_balance = \DB::table('users')->where('ref_get', $title)->pluck('money');
			
			if($users != $uid_refer && $uid_get == $title) {
				
				\DB::table('users')
				->where('id', $uid_refer)
				->update(array('money' => $uid_refer_balance + $bonus_ref));

				\DB::table('users')
				->where('id', $users)
				->update(array('ref_bonus' => 1, 'ref_url_bonus' => $title, 'money' => $balance + $bonus_user, 'date_ref' => $date_refers));
				
				
				header('refresh: 0.1');
			}
			else { return response()->json([ 'errors' => 'Вы ввели не верный код!']); 
			}
		}
		
		return view('ref.index', compact('refers'));
	}
}