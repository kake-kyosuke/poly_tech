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
      TODO管理機能
      <div class="right-aligned">
        <a href="http://localhost:8080/home">HOME</a>
      </div>
    </div>
    <article>
  <div class="side">
    <p>TODO管理</p>
  </div> 
  <div class="content">
  
    <h2>TODO一覧</h2>
    <p>ようこそ、{{ Auth::user()->name }}さん</p>

    <div class="backg">
      <!-- 検索機能ここから -->
      <form action="{{ route('todo.list') }}" method="GET">
      
      <div><p>
        <label><b>タイトル</b></label><br>
        <input type="text" name="title" value="{{ !empty($params['title']) ? $params['title'] : '' }}" size="50" placeholder="タイトル"><br>
      </p></div>

      <div><p>
        <label><b>詳細内容</b></label><br>
        <input type="text" name="content" value="{{ !empty($params['content']) ? $params['content'] : '' }}" size="50" placeholder="詳細内容になります。"><br>
      </p></div>

      <div><p>
        <label><b>開始日</b><br></label>
        <input type="date" name="start_from" value="{{ !empty($params['start_from']) ? $params['start_from'] : '' }}"> ～
        <input type="date" name="start_until" value="{{ !empty($params['start_until']) ? $params['start_until'] : '' }}"><br>
      </p></div>

      <div>
        <label><b>期限日</b><br></label>
        <input type="date" name="end_from" value="{{ !empty($params['end_from']) ? $params['end_from'] : '' }}"> ～
        <input type="date" name="end_until" value="{{ !empty($params['end_until']) ? $params['end_until'] : '' }}"><br>
      </p></div>

      <div><p>
        <label><b>ステータス</b></label><br>
        <input type="checkbox" name="status[]" value="0" {{ !empty($params['status[]']) == 0 ? 'checked' : '' }}>未着手
        <input type="checkbox" name="status[]" value="1" isset($params['status']) $params['status[1]'] === '1'>作業中
        <input type="checkbox" name="status[]" value="2" isset($params['status']) $params['status[2]'] === '2'>保留中
        <input type="checkbox" name="status[]" value="3" isset($params['status']) $params['status[3]'] === '3'>完了
      </p></div>
      <p><button type="submit" class="button3_1">検索</button></p>
      </form>
    <!-- 検索機能ここまで -->
    </div>
    @if(!isset($todolist))
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
          <th>タイトル</th>
          <th>詳細内容</th>
          <th>開始日</th>
          <th>期限日</th>
          <th>ステータス</th>
          <th>操作</th>
        </tr>
      
      <tbody>
        @foreach ($todolist as $todo)
        <tr>
          <th>{{ $todo->id ?? ''}}</th>
          <td>{{ $todo->title }}</td>
          <td>{{ $todo->content }}</td>
          <td>{{ $todo->start_date }}</td>
          <td>{{ $todo->end_date}}</td>
          <td><?php if( $todo->status==0 ){?>
            <div class="button3">
              未着手
            </div>
            <?php }else if( $todo->status==1 ){?>
            <div class="button3">
              作業中
            </div>
            <?php }else if( $todo->status==2 ){?>
            <div class="button3">
              保留中
            </div>
            <?php }else if( $todo->status==3 ){?>
            <div class="button3">
              完了
            </div>
            <?php } ?></td>

          <td>
            <div style="display:inline-flex">
              <form action="{{ route('details.list', ['id'=>$todo->id] ) }}" method="POST">
                @csrf
                <button class="button1" style="background-color:yellow"><b>詳細</b></button>
              </form>
          
              <form action="{{ route('edit.list',  ['id'=>$todo->id]) }}" method="GET">
                @csrf
                <button class="button2" style="background-color:green">編集</button>
              </form>
          
              <form action="{{ route('todo.delete', ['id'=>$todo->id] ) }}" method="POST">
                @csrf
                <button class="button2" style="background-color:red" type="submit">削除</button>
              </form>
            
          </td>
        </tr>
        @endforeach
      </tbody>
      </table>
      @endif
    
      {{ $todolist->links() }}
      <br>
      <form action="{{ route('new.list') }}" method="GET">
        <button type="submit" class="button3_1">新規作成</button>
      </form>
    </div> 
  </div> 
</article>

</body>
</html>
