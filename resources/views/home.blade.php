@extends ('layouts.app')

@section('nav')
<nav class="tabs is-boxed is-fullwidth">
  <div class="container">
    <ul>
      <li class="is-active"><a href="{{ route('home') }}">Lots à traiter</a></li>
      <li><a href="{{ route('home.historique') }}">Historique des lots traités</a></li>
    </ul>
  </div>
</nav>
@endsection

@section('content')
<nav class="breadcrumb is-small" aria-label="breadcrumbs">
  <ul>
    <li><a href="#">Accueil</a></li>
    <li class="is-active"><a href="#" aria-current="page">Lots à traiter</a></li>
  </ul>
</nav>

<!-- Main container -->
<nav class="level">
  <!-- Left side -->
  <div class="level-left">
    <div class="level-item">
      <p class="subtitle is-5">
        <strong>{{ count($lots) }}</strong> lot(s)
      </p>
    </div>
    <div class="level-item">
      <form action="{{ route('home.search') }}" method="get">
        <div class="field has-addons">
          <p class="control">
            <input class="input" name="name" type="text" placeholder="Trouver un projet">
          </p>
          <p class="control">
            <button class="button">
              Recherche
            </button>
          </p>
        </div>
      </form>
  </div>
</nav>

<!-- TABLE -->
<div class="columns is-centered">
  <table class="table">
    <thead>
      <tr>
      	<th>Lot n°</th>
        <th>Nom de projet</th>
        <th>Chef de projet</th>
        <th>Nbr. de documents</th>
        <th>Nbr. de pages</th>
        <th>Précédente durée de traitement</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($lots as $lot)
        <tr>
          <td>{{ $lot->num }}</td>
          <td>{{ $lot->projet->name }}</td>
          <td>{{ $lot->projet->user->name }}</td>
          <td>{{ $lot->nbrDoc }}</td>
          <td>{{ $lot->nbrPage }}</td>
          <td>{{ gmdate("H:i:s", $lot->time) }}</td>
          <td>
          	<chrono  v-if="{{ !$lot->completed }}" :lot_id="{{ $lot->id }}"></chrono>
          </td>
          <td>
            <form action="{{ route('lots.save') }}" method="post">
              {{ csrf_field() }}

              <input type="hidden" name="lot_id" v-model="lot_id">
              <input type="hidden" name="time" v-model="time">
              <button v-if="timePaused" class="button is-small is-info is-outlined">Reporter</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

<!-- MODAL ADD -->
<div class="modal is-active" v-if="showObservation">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Observation</p>
      <button class="delete" aria-label="close" @click="showObservation = false"></button>
    </header>
    <form id="form" action="{{ route('lots.complete') }}" method="post">
    	{{ csrf_field() }}

  		<section class="modal-card-body">
  			<input type="hidden" name="lot_id" v-model="lot_id">
  			<input type="hidden" name="time" v-model="time">

  			<div class="field">
  	          <label class="label">Observation</label>
  	          <div class="control">
  	            <div class="select">
  					<select name="observation">
  						<option value="" disabled>Choisir une observation</option>
  						<option value="">Aucune</option>
  						<option>observation 1</option>
  						<option>observation 2</option>
  						<option>observation 3</option>
  					</select>
  				</div>
  	          </div>
  	        </div>
  		</section>
  		<footer class="modal-card-foot">
  		  <button class="button is-primary" type="submit">Terminer</button>
  		  <button class="button" @click.prevent="showObservation = false">Annuler</button>
  		</footer>
  	</form>
  </div>
</div>
<!-- END MODAL ADD -->
@endsection