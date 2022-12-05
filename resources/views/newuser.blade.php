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
        <h2>USER新規登録</h2>

          @if ($errors->any())
            <p></p><div class="error_main">
              入力エラーがあります。
            </div></p>
          @endif

        <form action="{{ route('confirm.user') }}" method="POST">
        @csrf
          <div class="backg">
            <div><p>
              <label><b>氏名</b></label><span class="required">必須</span><br>
              <input type="text" name="name" value="{{ old('name') }}" size="50" placeholder=""><br>
              <div class="error_sub">
                @foreach ($errors->get('name') as $error)
                  {{ $error }}<br>
                @endforeach
              </div>
            </p></div>

            <div><p>
              <label><b>メールアドレス</b></label><span class="required">必須</span><br>
              <input type="text" name="email" value="{{ old('email') }}" size="50" placeholder="test@test.co.jp"><br>
                <div class="error_sub">
                  @foreach ($errors->get('email') as $error)
                    {{ $error }}<br>
                  @endforeach
                </div>
            </p></div>

            <div><p>
              <label><b>パスワード</b></label><span class="required">必須</span><br>
              <input type="password" name="password" value="{{ old('password') }}" size="50" placeholder="password"><br>
                <div class="error_sub">
                  @foreach ($errors->get('password') as $error)
                    {{ $error }}<br>
                  @endforeach
                </div>
            </p></div>

            <div><p>
              <label><b>ステータス</b></label><br>
              <input type="radio" name="status" value="0" checked>有効
              <input type="radio" name="status" value="1">無効
            </p></div>
            <p><button type="submit" class="button3_1">確認画面へ</button></p>
        </form>
      </div>

    </article>

</body>
</html>
