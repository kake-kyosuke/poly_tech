<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class userController extends BaseController
{
    /*
    |========================
    | TODO一覧（検索機能含む）|
    |========================
    */
    
    public function userlist(Request $request)
    {
        // 検索欄で入力された値を取得する
        $params = $request->all();
        // var_dump($params["title"]);

        // クエリビルダ
        $query = User::query();

        // ユーザーID 取得  queryにID一致させる
        //$user_id = Auth::id();
        //$query -> with('user')->where('user_id', '=', $user_id);

        /*=============================
        | DBカラム名を変数$paramsで検索 |
        =============================*/
        if(!empty($params["name"])){
            $query->where('name', 'like', "%{$params['name']}%");
        }
        if(!empty($params["mail"])){
            $query->where('email', 'like', "%{$params['mail']}%");
        }
        // if (is_array($searchStatus = $request->input('status'))) {
        //     $query->where(function($q) use($request){
        //         foreach($request->input('status') as $status){
        //             $q->orWhere('status',$status);
        //         }
        //     });
        // }
        // 昇順降順(sort)が押され、かつ値が１なら
        if(isset($params['sort']) && $params['sort'] === '1') {
            $userlist = $query->orderBy('id','desc');
        }else{
            $userlist = $query->paginate($request->input('num', 5));
        }
        
        //dd($todolist);
        return view ('userlist', compact('userlist','params'));
    }


    /*
    |============
    |  削除機能  |
    |============
    */
    public function delete($id)
    {
        // Userテーブルから指定のIDのレコード1件を取得
        $user = User::find($id);
        // 削除
        $user->delete();
        // 削除したら一覧画面にリダイレクト
        return redirect('/todo/user');
    }


    /*
    |==============
    |  詳細ページ  |
    |==============
    */
    public function details($id)
    {
        // Todosテーブルから指定のIDのレコード1件を取得
        $todo = Todo::find($id);
        return view('detailslist', ['todo' => $todo]);
    }

    /*
    |================
    |  1.入力ページ  |
    |================
    */
    public function newuser()
    {
        return view ('newuser');
    }
    /*
    |================
    |  2.確認ページ  |
    |================
    */
    public function confirm(Request  $request, $id=NULL)
    {
        //dd($request->all());
        $user = User::find($id);

        /*==============
        | バリデーション |
        ==============*/
        $request->validate([
            'name' => ['required','max:32'],
            'email' => ['required','max:255'],
            'password' => ['required','max:32'],
        ]);

        $input_date = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => $request->status
        ];

        return view ('confuser', $input_date); 
    }
    /*
    |====================
    |  3.登録画面ページ   |
    |====================
    */
    public function add(Request $request, $id = NULL) //registcomp
    {
        //登録が押された場合
        if($request->post('ok')){
            if($id == NULL){ //id無い➡新規
                $user = new User();
                $user->fill($request->all())->save();
                return view ('registcompuser');
            }else{ //id有る➡変更
                User::find($id)->update($request->all());
                return view ('registcompuser');
            }
        }
        //戻るが押された場合
        if ($request->get('back')){
            if($id == NULL){ //id無い➡新規
                return redirect('/todo/user/newuser')->withInput();
            }else{ //id有る➡変更
                User::find($id);
                return redirect()->route('edit.user', ['id'=>$id])->withInput();
                //return view ('edit');
            }
            
        }
    }
    /*
    |================
    |  4.完了ページ  |
    |================   //2.DB送信で使ってるからいらないのでは？？
    */
    public function success() 
    {
        return view ('registcompuser');
    }

    /*
    |==============
    |  編集ページ  |
    |==============
    */
    public function editing($id)
    {
        $user = User::find($id);
        return view ('edituser', ['user' => $user]);
    }

    //データ確認：dd($request->all());
}
