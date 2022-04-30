# Portfolio

# Prérequis
<ul>
    <li><a href="https://www.wampserver.com/" target="_blank">WampServer</a> ou <a href="https://www.apachefriends.org/fr/index.html" target="_blank">XAMPP</a></li>
    <li><a href="https://www.glob.com.au/sendmail/" target="_blank">sendmail</a></li>
    <li>Éditeur de code</li>
</ul>

# Installation de sendmail
<ol>
    <li>Déplacez le dossier sendmail dans le dossier wamp64</li>
    <pre><code>C:\wamp64</code></pre>
    <li>Modifiez le fichier sendmail.ini du dossier sendmail</li>
    <pre><code>smtp_server=smtp.gmail.com</code></pre>
    <pre><code>smtp_port=587</code></pre>
    <pre><code>;default_domain=gmail.com</code></pre>
    <pre><code>auth_username=votreemail@gmail.com</code></pre>
    <pre><code>auth_password=MotDePasseDuCompte</code></pre>
    <pre><code>force_sender=votreemail@gmail.com</code></pre>
    <li>Modifiez le fichier php.ini de WampServer</li>
    <pre><code>C:\wamp64\bin\apache\apache2.4.46\bin\php.ini</code></pre>
    <pre><code>sendmail_path = "C:\wamp64\sendmail\sendmail.exe"</code></pre>
    <li>Redémarrez WampServer</li>
</ol>

# Connexion à la base de données
<ol>
    <li>Ouvrez la console MariaDB de WampServer</li>
    <pre><code>C:\wamp64\bin\mariadb\mariadb10.4.13\bin\mysql.exe</code></pre>
    <li>Copiez la base de données portfolio.sql dans la console</li>
</ol>

# Accéder au Portfolio
<ol>
    <li><b>Déplacez</b> le dossier Portfolio dans le dossier <b>www</b> de WampServer</li>
    <pre><code>C:\wamp64\www</code></pre>
    <li><b>Démarrez</b> WampServer</li>
    <li>Se rendre dans le dossier Portfolio depuis le navigateur</li>
    <pre><code>http://localhost/Portfolio</code></pre>
</ol>

# Partie administrative
<pre><code>http://localhost/Portfolio/admin-panel</code></pre>
<b>Pseudo :</b> Yassine<br>
<b>Mot de passe :</b> Azerty123

