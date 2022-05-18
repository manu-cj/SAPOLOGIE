<?php
?>

<h1>Contact</h1>
<br>
<br>
<div id="contactForm">
    <form method="post" action="?c=contact">

        <p>Veullez remplir tous les champs</p>
        <br>
        <label for="mail">E-mail :</label>
        <br>
        <input type="email" name="mail" id="mail" required>
        <br>
        <label for="sujet">Sujet :</label>
        <br>
        <input type="text" name="sujet" id="sujet" required>
        <br>
        <br>
        <label for="message">Message :</label>
        <br>
        <br>
        <script src="https://cdn.tiny.cloud/1/08tk3tb9upwr2o8kaqae77xiv3mufz3e7h80zpr0h0o0zemd/tinymce/5/tinymce.min.js"
                referrerpolicy="origin"></script>
        </head>
        <body>
        <textarea name="message" id="message"></textarea>

        <br>
        <input type="submit" name="send" id="send">
    </form>
</div>
<script>
    tinymce.init({
        selector: 'textarea',
        plugins: 'a11ychecker advcode casechange export formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
        toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table',
        toolbar_mode: 'floating',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
    });
</script>