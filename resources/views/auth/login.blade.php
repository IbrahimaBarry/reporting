<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/app.css">

        <style>
            body, html {
                height: 100%;
            }

            .card {
              -webkit-box-shadow: 0px 18px 60px -13px rgba(224,213,224,1);
              -moz-box-shadow: 0px 18px 60px -13px rgba(224,213,224,1);
              box-shadow: 0px 18px 60px -13px rgba(224,213,224,1);
              border-radius: 5%
            }

            .title {
              color: #bbb;
              margin-top: 150px;
              margin-bottom: 40px;
              text-align: center
            }
        </style>

    </head>
    <body>

        <h1 class="title is-1 is-primary">{{ config('app.name', 'Laravel') }}</h1>
        
        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            
            <div class="card column is-half is-offset-one-quarter">
              <header class="card-header">
                <p class="card-header-title">
                  Authentification
                </p>
              </header>
              <div class="card-content">

                <div class="field">
                  <label class="label">Email</label>
                  <p class="control has-icons-left has-icons-right">
                    <input class="input{{ $errors->has('email') ? ' is-danger' : ' is-success' }}" type="email" placeholder="Saisir vorte e-mail" value="{{ old('email') }}" name="email">
                    <span class="icon is-small is-left">
                      <i class="fa fa-envelope"></i>
                    </span>

                    @if ($errors->has('email'))
                        <span class="icon is-small is-right">
                          <i class="fa fa-warning"></i>
                        </span>
                    @endif
                  </p>
                  @if ($errors->has('email'))
                    <p class="help is-danger">{{ $errors->first('email') }}</p>
                  @endif
                </div>

                <div class="field">
                  <label class="label">Mot de passe</label>
                  <p class="control has-icons-left has-icons-right">
                    <input class="input {{ $errors->has('password') ? ' is-danger' : ' is-success' }}" type="password" placeholder="Saisir vorte mot de passe" value="{{ old('password') }}" name="password">
                    <span class="icon is-small is-left">
                      <i class="fa fa-key"></i>
                    </span>

                    @if ($errors->has('password'))
                        <span class="icon is-small is-right">
                          <i class="fa fa-warning"></i>
                        </span>
                    @endif
                  </p>
                  @if ($errors->has('password'))
                    <p class="help is-danger">{{ $errors->first('password') }}</p>
                  @endif
                </div>

              </div>
              <footer class="card-footer column is-half is-offset-one-quarter">
                <button type="submit" class="button is-info column is-12">Connexion</button>
              </footer>
            </div>
        </form>

    </body>
</html>

