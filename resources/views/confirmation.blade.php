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
    <h2>確認画面</h2>

    @if(isset($todo))
    <form action="{{ route('registcomp', ['id'=>$todo->id]) }}" method="POST">
    @else
    <form action="{{ route('registcomp') }}" method="POST">
    @endif

    @csrf
    <div class="backg">
      <div>
        <label><b>タイトル</b></label><br>
        <p><span>{{ $title }}</span></p>
        <input name="title" value="{{ $title }}" type="hidden">
      </div>

      <div>
        <label><b>詳細内容</b></label><br>
        <p><span>{{ $content }}</span></p>
        <input name="content" value="{{ $content }}" type="hidden">
      </div>

      <div>
        <label><b>開始日</b></label><br>
        <p><span>{{ $start_date }}</span></p>
        <input name="start_date" value="{{ $start_date }}" type="hidden">
      </div>

      <div>
        <label><b>期限日</b></label><br>
        <p><span>{{ $end_date }}</span></p>
        <input name="end_date" value="{{ $end_date }}" type="hidden">
      </div>

      <div>
        <b>ステータス</b><br>
        <p><?php if( $status==0 ){?>
        未着手
        <?php }else if( $status==1 ){?>
        作業中
        <?php }else if( $status==2 ){?>
        保留中
        <?php }else if( $status==3 ){?>
        完了
        <?php } ?></p>
        <input name="status" value="{{ $status }}" type="hidden">
      </div>
      
      <div style="display:inline-flex">
        <button type="submit" value="Add" name="ok" class="button3_1">登録する</button>
        <button type="submit" value="Add" name="back" class="button3_1">戻る</button>
      </div>

    </form>
    </div>
  </div>
  <!-- </form> @csrf-->
  </div>

</article>
</body>
</html>
