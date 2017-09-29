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
    <li class="is-active"><a href="#" aria-current="page">Gestion des agents</a></li>
  </ul>
</nav>

<!-- Main container -->
<nav class="level">
  <!-- Left side -->
  <div class="level-left">
    <div class="level-item">
      <p class="subtitle is-5">
        <strong>{{ $users->total() }}</strong> agent(s)
      </p>
    </div>
    <div class="level-item">
      <form action="{{ route('users.search') }}" method="get">
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
  </div>

  <div class="level-right">
    <div class="level-item">
      <a href="{{ route('users.create') }}" class="button is-light">Ajouter un agent</a>
    </div>
  </div>
</nav>

<!-- FONCTION PHP POUR FAIRE LA SOMME -->
@php
  function getTime ($lots) {
    $sum = 0;
    foreach ($lots as $lot) {
      $sum += $lot->time;
    }
    return gmdate("H:i:s", $sum);
  }

  function getDocs ($lots) {
    $sum = 0;
    foreach ($lots as $lot) {
      $sum += $lot->nbrDoc;
    }
    return $sum;
  }

  function getPages ($lots) {
    $sum = 0;
    foreach ($lots as $lot) {
      $sum += $lot->nbrPage;
    }
    return $sum;
  }
@endphp
<!-- END FONCTION -->

<!-- TABLE -->
<div class="columns is-centered">
  <table class="table">
    <thead>
      <tr>
        <th>Nom agent</th>
        <th>Nbr. de lots traités</th>
        <th>Durée traitement</th>
        <th>Nbr. de documents</th>
        <th>Nbr. de pages</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
        <tr>
          <td>{{ $user->name }}</td>
          <td>{{ count($user->lots->where('completed', true)) }}</td>
          <td>{{ getTime($user->lots->where('completed', true)) }}</td>
          <td>{{ getDocs($user->lots->where('completed', true)) }}</td>
          <td>{{ getPages($user->lots->where('completed', true)) }}</td>
          <td>
            <a href="" class="tag is-delete" onclick="event.preventDefault();
                                                          document.getElementById('{{ $user->id }}').submit();"></a>

            <form id="{{ $user->id }}" action="{{ route('users.destroy', $user) }}" method="post">
              {{ method_field('DELETE') }}
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

{{ $users->links() }}
@endsection