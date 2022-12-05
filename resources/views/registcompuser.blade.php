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
  <div class=bar>User管理機能</div>
  <article>
  <div class="side">
    <p>User管理</p>
  </div> 
  <div class="content">
  <h2>User登録・編集完了</h2><br>

  <div class="backg">
    <form action="{{ route('user.list') }}" method="GET">
      @csrf
      <button class="button3_1">検索一覧へ</button>
    </form>
  </div>
  </article>
  </body>
</html>
