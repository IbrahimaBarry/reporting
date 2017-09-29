@extends ('layouts.app')

@section('nav')
<nav class="tabs is-boxed is-fullwidth">
  <div class="container">
    <ul>
      <li><a href="{{ route('projets.index') }}">Gestion des projets</a></li>
      <li class="is-active"><a href="{{ route('users.index') }}">Gestion des agents</a></li>
    </ul>
  </div>
</nav>
@endsection

@section('content')
<nav class="breadcrumb is-small" aria-label="breadcrumbs">
  <ul>
    <li><a href="#">Espace administration</a></li>
    <li ><a href="{{ route('users.index') }}">Gestion des agents</a></li>
    <li class="is-active"><a href="#" aria-current="page">Ajouter un agent</a></li>
  </ul>
</nav>

<!-- FORM -->
<div class="columns">
	<form class="column is-half is-offset-one-quarter" action="{{ route('register') }}" method="post">
		{{ csrf_field() }}

		<div class="field">
		  <label class="label">Nom</label>
		  <div class="control has-icons-left has-icons-right">
		    <input class="input{{ $errors->has('name') ? ' is-success' : '' }}" type="text" name="name" placeholder="Saisir le nom et le prenom" value="{{ old('name') }}" required>
		    <span class="icon is-small is-left">
		      <i class="fa fa-user"></i>
		    </span>

		    @if ($errors->has('name'))
            	<span class="icon is-small is-right">
			      <i class="fa fa-warning"></i>
			    </span>
			    <p class="help is-danger">{{ $errors->first('name') }}</p>
            @endif
		  </div>
		</div>

		<div class="field">
		  <label class="label">Email</label>
		  <div class="control has-icons-left has-icons-right">
		    <input class="input{{ $errors->has('name') ? '  is-danger' : '' }}" type="email" name="email" placeholder="Saisir Email" value="{{ old('email') }}" required>
		    <span class="icon is-small is-left">
		      <i class="fa fa-envelope"></i>
		    </span>

		    @if ($errors->has('email'))
            	<span class="icon is-small is-right">
			      <i class="fa fa-warning"></i>
			    </span>
			    <p class="help is-danger">{{ $errors->first('email') }}</p>
            @endif
          </div>
		</div>

		<div class="field">
		  <label class="label">Mot de passe</label>
		  <div class="control has-icons-left has-icons-right">
		    <input class="input{{ $errors->has('password') ? '  is-danger' : '' }}" type="password" name="password" placeholder="Saisir mot de passe" required>
		    <span class="icon is-small is-left">
		      <i class="fa fa-key"></i>
		    </span>

		    @if ($errors->has('password'))
            	<span class="icon is-small is-right">
			      <i class="fa fa-warning"></i>
			    </span>
			    <p class="help is-danger">{{ $errors->first('password') }}</p>
            @endif
          </div>
		</div>

		<div class="field">
		  <label class="label">Confirmer mot de passe</label>
		  <div class="control has-icons-left has-icons-right">
		    <input class="input" type="password" name="password_confirmation" placeholder="Confirmer mot de passe" required>
		    <span class="icon is-small is-left">
		      <i class="fa fa-key"></i>
		    </span>
		  </div>
		</div>

		<div class="field">
		  <label class="label">Rôle</label>
		  <div class="control">
		    <div class="select">
		      <select name="role" required>
		        <option disabled>-- Selectionnez un rôle --</option>
		        <option value="agent">Agent d'indexation</option>
		        <option value="admin">Chef de projet</option>
		      </select>
		    </div>
		  </div>
		</div>

		<div class="field is-grouped">
		  <div class="control">
		    <button class="button is-primary">Enregistrer</button>
		  </div>
		</div>
	</form>
</div>
<!-- END FORM -->
@endsection