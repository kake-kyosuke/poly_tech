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
  <div class=bar>TODO管理機能</div>
    <article>
  <div class="side">
    <p>TODO管理</p>
  </div> 
  <div class="content">
    <h2>TODO詳細</h2>
    <div class="backg">
      <b>タイトル</b><br>
      <p>{{ $todo->title }}</p>
      <b>詳細内容</b><br>
      <p>{{ $todo->content }}</p>
      <b>開始日</b><br>
      <p>{{ $todo->start_date }}</p>
      <b>期限日</b><br>
      <p>{{ $todo->end_date }}</p>
      <b>ステータス</b><br>
      <p><?php if( $todo->status==0 ){?>
        未着手
      <?php }else if( $todo->status==1 ){?>
        作業中
      <?php }else if( $todo->status==2 ){?>
        保留中
      <?php }else if( $todo->status==3 ){?>
        完了
        <?php } ?></p>

      <div style="display:inline-flex">
      <form action="{{ route('todo.list') }}" method="GET">
        @csrf
        <button class="button3_1">検索一覧へ</button>
      </form>
      <form action="{{ route('edit.list',  ['id'=>$todo->id]) }}" method="GET">
        @csrf
        <button class="button3_1">編集へ</button>
      </div>
    </div>
    </form>
  </div>

</article>
</body>
</html>
