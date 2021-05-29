<?php

$markdown = file_get_contents('markdown.md');
?>

<html>
<head>
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/github-markdown-css/3.0.1/github-markdown.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet">
</head>
<body>
  <div class="main-flex flow-column">
    <div class="btn-flex">
      <button class="btn btn-seccondary edit-btn" start="# " end="">見出し1</button>
      <button class="btn btn-seccondary edit-btn" start="## " end="">見出し2</button>
      <button class="btn btn-seccondary edit-btn" start="### " end="">見出し3</button>
      <button class="btn btn-seccondary edit-btn" start="#### " end="">見出し4</button>
      <button class="btn btn-seccondary edit-btn" start="##### " end="">見出し5</button>
      <button class="btn btn-seccondary edit-btn" value="見出し6" start="###### " end="">見出し6</button>
      <button class="btn btn-seccondary edit-btn" value="リスト" start="- " end="">リスト</button>
      <button class="btn btn-seccondary edit-btn" value="inリスト" start="  - " end="">inリスト</button>
      <button class="btn btn-seccondary edit-btn" value="Numリスト" start="1. " end="">Numリスト</button>
      <button class="btn btn-seccondary edit-btn" value="inNumリスト" start="  1. " end="">inNumリスト</button>
      <button class="btn btn-seccondary edit-btn" value="強調" start="**" end="**">強調</button>
      <button class="btn btn-seccondary edit-btn" value="斜体" start="*" end="*">斜体</button>
      <button class="btn btn-seccondary edit-btn" value="伏字" start="~~" end="~~">伏字</button>
      <button class="btn btn-seccondary edit-btn" value="code" start="```\n" end="\n```">code</button>
      <button class="btn btn-seccondary edit-btn" value="横線" start="---\n" end="">横線</button>
      <button class="btn btn-seccondary edit-btn" style="color:red" value="横線" start='<span style="color:red;">' end='</span>'>■</button>
      <button class="btn btn-seccondary edit-btn" style="color:skyblue" value="横線" start='<span style="color:skyblue;">' end='</span>'>■</button>
      <button class="btn btn-seccondary edit-btn" style="color:#f472ff" value="横線" start='<span style="color:#f472ff;">' end='</span>'>■</button>
    </div>
    <div class="sub-flex flow-row">
      <textarea name="html" id="editor" class="editor"></textarea>
      <div id="md" class="markdown-body"></div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script>
    let selects = 0;
    let selecte = 0;
    let countZenkaku = 0;

    get_html();
    $('#editor').keyup(function(e) {
      if (e.keyCode != 229 || countZenkaku >= 5) {
        countZenkaku = 0;
        get_html();
      } else {
        countZenkaku += 1;
      }
    });
    $('#editor').keyup(function(e) {
      selects = this.selectionStart;
      selecte = this.selectionEnd;
    });

    $('#editor').mouseup(function(e) {
      selects = this.selectionStart;
      selecte = this.selectionEnd;
    });
    $('#editor').mouseleave(function(e) {
      selects = this.selectionStart;
      selecte = this.selectionEnd;
    });



    $(document).on('click', '.edit-btn', function(e) {
      let edit = $('#editor');
      let start = e.target.attributes.start.value;
      let end = e.target.attributes.end.value;
      start = start.replace(/\\n/, "\n");
      end = end.replace(/\\n/, "\n");

      edit.val(edit.val().slice(0, selects)+start+edit.val().slice(selects, selecte)+end+edit.val().slice(selecte));
      get_html();
      edit.focus();
    });

      // console.log(obj.attributes.start.value);

    function get_html ()
    {
      $.ajax('markdown.php',
          {
            type: 'get',
            data: {md: $('#editor').val()}
          }
        )
        .done(function(data) {
          $('#md').html(data);
        });
    }
  </script>
</body>
</html>