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

class todoController extends BaseController
{
    /*
    |========================
    | TODO一覧（検索機能含む）|
    |========================
    */
    
    public function todolist(Request $request)
    {
        // 検索欄で入力された値を取得する
        $params = $request->all();
        // var_dump($params["title"]);

        // クエリビルダ
        $query = Todo::query();

        // ユーザーID 取得  queryにID一致させる
        $user_id = Auth::id();
        $query -> with('user')->where('user_id', '=', $user_id);

        /*=============================
        | DBカラム名を変数$paramsで検索 |
        =============================*/
        if(!empty($params["title"])){
            $query->where('title', 'like', "%{$params['title']}%");
        }
        if(!empty($params["content"])){
            $query->where('content', 'like', "%{$params['content']}%");
        }
        // if (!empty($params["start_from"]) || !empty($params["start_until"])) {
        //     $query->whereBetween('start_date', [$params['start_from'], $params['start_until']]);
        // }
        if (!empty($params["start_from"])) {
            $query->where('start_date', ">=", $params['start_from']);
        }
        if (!empty($params["start_until"])) {
            $query->where('start_date', "<=", $params['start_until']);
        }
        // if (!empty($params["end_from"]) && !empty($params["end_until"])) {
        //     $query->whereBetween('end_date', [$params['end_from'], $params['end_until']]);
        // }
        if (!empty($params["end_from"])) {
            $query->where('end_date', ">=", $params['end_from']);
        }
        if (!empty($params["end_until"])) {
            $query->where('end_date', "<=", $params['end_until']);
        }
        if (is_array($searchStatus = $request->input('status'))) {
            $query->where(function($q) use($request){
                foreach($request->input('status') as $status){
                    $q->orWhere('status',$status);
                }
            });
        }
        // 昇順降順(sort)が押され、かつ値が１なら
        if(isset($params['sort']) && $params['sort'] === '1') {
            $todolist = $query->orderBy('id','desc')->paginate($request->input('num', 5));;
        }else{
            $todolist = $query->paginate($request->input('num', 5));
        }
        // if(!empty($params['sort'])) {
        //     if($params['sort'] === '1') {
        //         $todolist = Todo::orderBy($params['column'],'desc')->paginate($request->input('num', 5));
        //     }else{
        //         $todolist = Todo::orderBy($params['column'],'asc')->paginate($request->input('num', 5));
        //     }
        // }else{
        //     $todolist = $query->paginate($request->input('num', 5));
        // }
        
        //dd($todolist);
        return view ('todolist', compact('todolist','params'));
    }


    /*
    |============
    |  削除機能  |
    |============
    */
    public function delete($id)
    {
        // Todosテーブルから指定のIDのレコード1件を取得
        $todo = Todo::find($id);
        // 削除
        $todo->delete();
        // 削除したら一覧画面にリダイレクト
        return redirect('/todo/list');
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
    public function newlist()
    {
        return view ('newlist');
    }
    /*
    |================
    |  2.確認ページ  |
    |================
    */
    public function confirm(Request  $request, $id=NULL)
    {
        //dd($request->all());
        $todo = Todo::find($id);

        /*==============
        | バリデーション |
        ==============*/
        $request->validate([
            'title' => ['required','max:32'],
            'content' => ['max:1024'],
            'start_date' => ['nullable','date_format:Y-m-d'],
            'end_date' => ['nullable','date_format:Y-m-d'],
        ]);

        $input_date = [
            'todo' => $todo,
            'title' => $request->title,
            'content' => $request->content,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status
        ];

        return view ('confirmation', $input_date); 
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
                $todo = new Todo();
                $todo->fill($request->all())->save();
                return view ('registcomp');
            }else{ //id有る➡変更
                Todo::find($id)->update($request->all());
                return view ('registcomp');
            }
        }
        //戻るが押された場合
        if ($request->get('back')){
            if($id == NULL){ //id無い➡新規
                return redirect('/todo/list/newlist')->withInput();
            }else{ //id有る➡変更
                Todo::find($id);
                return redirect()->route('edit.list', ['id'=>$id])->withInput();
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
        return view ('registcomp');
    }

    /*
    |==============
    |  編集ページ  |
    |==============
    */
    public function editing($id)
    {
        $todo = Todo::find($id);
        return view ('edit', ['todo' => $todo]);
    }

    /*
    |=================
    |  登録データなし  |
    |=================
    */
    public function nodeta()
    {
        return view ('nodeta');
    }


    //データ確認：dd($request->all());
}
