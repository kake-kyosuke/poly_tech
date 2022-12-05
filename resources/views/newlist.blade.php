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
        <h2>TODO新規登録</h2>

        @if ($errors->any())
          <p></p><div class="error_main">
            入力エラーがあります。
          </div></p>
        @endif

      <form action="{{ route('confirm.list') }}" method="POST">
      @csrf
        <div class="backg">
          <div><p>
            <label><b>タイトル</b></label><span class="required">必須</span><br>
            <input type="text" name="title" value="{{ old('title') }}" size="50" placeholder="タイトル名"><br>
            <div class="error_sub">
              @foreach ($errors->get('title') as $error)
                {{ $error }}<br>
              @endforeach
            </div>
          </p></div>

          <div><p>
            <label><b>詳細内容</b></label><br>
            <textarea name="content" rows="6" cols="52" placeholder="詳細内容になります。">{{ old('content') }}</textarea><br>
              <div class="error_sub">
                @foreach ($errors->get('content') as $error)
                  {{ $error }}<br>
                @endforeach
              </div>
          </p></div>

          <div><p>
            <label><b>開始日</b><br></label>
            <input type="date" name="start_date" value="{{ old('start_date') }}"><br>
            <div class="error_sub">
                @foreach ($errors->get('start_date') as $error)
                  {{ $error }}<br>
                @endforeach
              </div>
          </p></div>

          <div>
            <label><b>期限日</b><br></label>
            <input type="date" name="end_date" value="{{ old('end_date') }}"><br>
            <div class="error_sub">
                @foreach ($errors->get('end_date') as $error)
                  {{ $error }}<br>
                @endforeach
              </div>
          </p></div>

          <div><p>
            <label><b>ステータス</b></label><br>
            <input type="radio" name="status" value="0" checked>未着手
            <input type="radio" name="status" value="1">作業中
            <input type="radio" name="status" value="2">保留中
            <input type="radio" name="status" value="3">完了
          </p></div>
          <p><button type="submit" class="button3_1">確認画面へ</button></p>
      </form>
      </div>
      </div>
        <!-- @if ($errors->any())
          <div class="error">
            <ul>
              @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
              @endforeach
            </ul>
          </div>
        @endif -->
    

    </article>

</body>
</html>
