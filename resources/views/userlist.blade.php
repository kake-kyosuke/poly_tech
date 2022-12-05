<!-- views -->

<!doctype html>
<html>
  <head>
    <title>todo</title>
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </head>

  <body>
    <div class=bar>
      TODO管理機能<a href="http://localhost:8080/home">-HOME-</a>
    </div>
    <article>
  <div class="side">
    <p>アカウント管理</p>
  </div> 
  <div class="content">
  
    <h2>アカウント一覧</h2>
    <p>ようこそ、{{ Auth::user()->name }}さん</p>

    <div class="backg">
      <!-- 検索機能ここから -->
      <form action="{{ route('user.list') }}" method="GET">
      
      <div><p>
        <label><b>氏名</b></label><br>
        <input type="text" name="name" value="{{ !empty($params['title']) ? $params['title'] : '' }}" size="50" placeholder="タイトル"><br>
      </p></div>

      <div><p>
        <label><b>メールアドレス</b></label><br>
        <input type="text" name="mail" value="{{ !empty($params['content']) ? $params['content'] : '' }}" size="50" placeholder="詳細内容になります。"><br>
      </p></div>

      <div><p>
        <label><b>ステータス</b></label><br>
        <input type="checkbox" name="status[0]" value="0" isset($params['status']) $params['status[0]'] === '0'>管理者
        <input type="checkbox" name="status[1]" value="1" isset($params['status']) $params['status[1]'] === '1'>一般
      </p></div>
      <p><button type="submit" class="button3_1">検索</button></p>
      </form>
    <!-- 検索機能ここまで -->
    </div>
    @if(!isset($userlist))
        <br>データはありません。<br>
      @else
      <p>
        <!-- ページャ表示件数 -->
          <div class="right-aligned">
            <form action="{{ route('todo.list') }}" method="GET">
              No:
              <select name="sort" onchange="submit();">
              <option value="0" {{ ($params['sort'] ?? "") == 0 ? 'selected' : '' }}>昇順</option>
              <option value="1" {{ ($params['sort'] ?? "") == 1 ? 'selected' : '' }}>降順</option>
              </select>
            </form>
          </div>
          <div class="right-aligned">
            <form action="{{ route('todo.list') }}" method="GET">
              表示件数：
              <select name="num" onchange="submit();">
              <option value="5" {{ ($params['num'] ?? "") == 5 ? 'selected' : '' }}>5</option>
              <option value="10" {{ ($params['num'] ?? "") == 10 ? 'selected' : '' }}>10</option>
              <option value="20" {{ ($params['num'] ?? "") == 20 ? 'selected' : '' }}>20</option>
              <option value="30" {{ ($params['num'] ?? "") == 30 ? 'selected' : '' }}>30</option>
              <option value="40" {{ ($params['num'] ?? "") == 40 ? 'selected' : '' }}>40</option>
              <option value="50" {{ ($params['num'] ?? "") == 50 ? 'selected' : '' }}>50</option>
              </select>
            </form>
          </div>
        </p>

    <!-- TODO一覧 -->
      <table class="table table-bordered">
        <tr>
          <th>No</th>
          <th>名前</th>
          <th>メールアドレス</th>
          <th>操作</th>
        </tr>
      
      <tbody>
        @foreach ($userlist as $user)
        <tr>
          <th>{{ $user->id ?? ''}}</th>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>
            <div style="display:inline-flex">
          
              <form action="{{ route('edit.user',  ['id'=>$user->id]) }}" method="GET">
                @csrf
                <button class="button2" style="background-color:green">編集</button>
              </form>
          
              <form action="{{ route('user.delete', ['id'=>$user->id] ) }}" method="POST">
                @csrf
                <button class="button2" style="background-color:red" type="submit">削除</button>
              </form>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
      </table>
      @endif

      {{ $userlist->appends(request()->input())->links() }}
      <br>
      <form action="{{ route('new.user') }}" method="GET">
        <button type="submit" class="button3_1">新規作成</button>
      </form>
  </div> 
</article>

</body>
</html>
