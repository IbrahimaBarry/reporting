@extends ('layouts.app')

@section('nav')
<nav class="tabs is-boxed is-fullwidth">
  <div class="container">
    <ul>
      <li><a href="{{ route('home') }}">Lots à traiter</a></li>
      <li class="is-active"><a href="{{ route('home.historique') }}">Historique des lots traités</a></li>
    </ul>
  </div>
</nav>
@endsection

@section('content')
<nav class="breadcrumb is-small" aria-label="breadcrumbs">
  <ul>
    <li><a href="#">Accueil</a></li>
    <li class="is-active"><a href="#" aria-current="page">Historique des lots traités</a></li>
  </ul>
</nav>

<!-- Main container -->
<nav class="level">
  <!-- Left side -->
  <div class="level-left">
    <div class="level-item">
      <p class="subtitle is-5">
        <strong>{{ $lots->total() }}</strong> lot(s)
      </p>
    </div>
    <div class="level-item">
      <div class="field has-addons">
        <p class="control">
          <input class="input" type="text" placeholder="Trouver un projet">
        </p>
        <p class="control">
          <button class="button">
            Recherche
          </button>
        </p>
      </div>
    </div>
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
        <th>Status du projet</th>
        <th>Nbr. de documents</th>
        <th>Nbr. de pages</th>
        <th>Temps de traitement</th>
        <th>Observation</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($lots as $lot)
        <tr>
          <td>{{ $lot->num }}</td>
          <td>{{ $lot->projet->name }}</td>
          <td>{{ $lot->projet->user->name }}</td>
          <td>
            @if ($lot->projet->completed)
              <span class="tag is-rounded is-primary">Terminé</span>
            @else
              <span class="tag is-rounded is-warning">Non terminé</span>
            @endif
          </td>
          <td>{{ $lot->nbrDoc }}</td>
          <td>{{ $lot->nbrPage }}</td>
          <td>{{ gmdate("H:i:s", $lot->time) }}</td>
          <td>{{ $lot->observation }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

{{ $lots->links() }}
@endsection