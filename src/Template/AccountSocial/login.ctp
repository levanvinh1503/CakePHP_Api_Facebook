<h2 class="title-login">Đăng nhập</h2>
<?= $this->Flash->render('login')?>
<?= $this->Html->link('Đăng nhập với Facebook', [
    'controller' => 'AccountSocial',
    'action' => 'loginFacebook',
], [
    'escape' => false,
    'class' => 'js-login-facebook btn btn-primary',
    'scope' => 'public_profile, email',
])?>
<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '1709496319176798',
            cookie     : true,
            xfbml      : true,
            version    : 'v3.1'
        });
        $('.js-login-facebook').click(function () {
            var url = $(this).attr('href');
            FB.login(function(response) {
                var accessToken = response.authResponse.accessToken;
                if (response.authResponse) {
                    window.location = url + '?access_token=' + accessToken;
                }
            }, {scope: 'public_profile, email'});

            return false;
        });

        FB.AppEvents.logPageView();
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
