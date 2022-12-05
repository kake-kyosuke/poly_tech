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
    <p>アカウント管理</p>
  </div> 
  <div class="content">
    <h2>確認画面</h2>

    @if(isset($user))
    <form action="{{ route('registcomp.user', ['id'=>$user->id]) }}" method="POST">
    @else
    <form action="{{ route('registcomp.user') }}" method="POST">
    @endif

    @csrf
    <div class="backg">
      <div>
        <label><b>氏名</b></label><br>
        <p><span>{{ $name }}</span></p>
        <input name="name" value="{{ $name }}" type="hidden">
      </div>

      <div>
        <label><b>メールアドレス</b></label><br>
        <p><span>{{ $email }}</span></p>
        <input name="email" value="{{ $email }}" type="hidden">
      </div>

      <div>
        <!-- <label><b>パスワード</b></label><br> -->
        <!-- <p><span>{{ $password }}</span></p> -->
        <input name="password" value="{{ $password }}" type="hidden">
      </div>

      <div>
        <b>管理者タイプ</b><br>
        <p><?php if( $status==0 ){?>
        管理者
        <?php }else if( $status==1 ){?>
        一般
        <?php } ?></p>
        <input name="status" value="{{ $status }}" type="hidden">
      </div>
      
      <div style="display:inline-flex">
        <button type="submit" value="Add" name="ok" class="button3_1">登録する</button>
        <button type="submit" value="Add" name="back" class="button3_1">戻る</button>
      </div>
    </div>
  </div>

</article>
</body>
</html>
