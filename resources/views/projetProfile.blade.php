@extends ('layouts.app')

@section('nav')
<nav class="tabs is-boxed is-fullwidth">
  <div class="container">
    <ul>
      <li class="is-active"><a href="{{ route('projets.index') }}">Gestion des projets</a></li>
      <li><a href="{{ route('users.index') }}">Gestion des agents</a></li>
    </ul>
  </div>
</nav>
@endsection

@section('content')
<nav class="breadcrumb is-small" aria-label="breadcrumbs">
  <ul>
    <li><a href="#">Espace administration</a></li>
    <li><a href="{{ route('projets.index') }}">Gestion des projets</a></li>
    <li class="is-active"><a href="#" aria-current="page">{{ $projet->name }}</a></li>
  </ul>
</nav>

<div class="columns">
  <div class="column is-3">
    <div class="notification is-info">
      <h4 class="title is-4">{{ $projet->name }}</h4>
      <p>
        <h6 class="subtitle is-6">Description :</h6> {{ $projet->description }}
      </p>
    </div>
    <div class="notification is-light">
      <h4 class="title is-4">Informations</h4>
      <p>Chef de projet : {{ $projet->user->name }}</p>
      <p>Nombre de lots : {{ $projet->nbrLot }}</p>
      <p>Status : 
        @if ($projet->completed)
          <span class="tag is-rounded is-primary">Terminé</span>
        @else
          <span class="tag is-rounded is-warning">Non terminé</span>
        @endif
      </p>
    </div>
  </div>
  <div class="column">
    <div>
      @if ($projet->completed)
        <a href="{{ route('projets.completed', $projet) }}" class="button is-light">Re-ouvrir le projet</a>
      @else
        <a href="{{ route('projets.completed', $projet) }}" class="button is-light">Fermer le projet</a>
      @endif
      <a class="button is-info is-outlined" @click="edit({{ $projet->lots }})">Modifier</a>
    </div>
    <div class="box">
      <p class="title"></p>
      <table class="table">
        <thead>
          <tr>
            <th>Lot n°</th>
            <th>Nbr. de documents</th>
            <th>Nbr. de pages</th>
            <th>Status du lot</th>
            <th>Agent chargé du traitement</th>
            <th>Durée du traitement</th>
            <th>Observation</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($projet->lots as $lot)
            <tr>
              <td>{{ $lot->num }}</td>
              <td>{{ $lot->nbrDoc }}</td>
              <td>{{ $lot->nbrPage }}</td>
              <td>
                @if ($lot->completed)
                  <span class="tag is-rounded is-primary">Terminé</span>
                @else
                  <span class="tag is-rounded is-warning">Non terminé</span>
                @endif
              </td>
              @if ($lot->user)
                <td>{{ $lot->user->name }}</td>
              @else
                <td></td>
              @endif
              <td>{{ gmdate("H:i:s", $lot->time) }}</td>
              <td>{{ $lot->observation }}</td>
              <td v-if="{{ $lot->completed }}">
                <a href="" class="tag is-delete" onclick="event.preventDefault();
                                                              document.getElementById('{{ $lot->id }}').submit();"></a>

                <form id="{{ $lot->id }}" action="{{ route('lots.uncomplete', $lot) }}" method="post">
                  {{ method_field('PUT') }}
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- MODAL EDIT -->
<div class="modal is-active" v-if="showModalEdit">
  <div class="modal-background"></div>
  <div class="modal-card" style="width: 810px">
    <header class="modal-card-head">
      <p class="modal-card-title">Editer le projet</p>
      <button class="delete" aria-label="close" @click="showModalEdit = false"></button>
    </header>
    <form action="{{ route('projets.update', $projet) }}" method="post">
      {{ method_field('PUT') }}
      <input type="hidden" name="_token" value="{{ csrf_token() }}">

      <section class="modal-card-body">
        <table class="table">
          <thead>
            <tr>
              <th>Lot n°</th>
              <th>Nombre de documents</th>
              <th>Nombre de de pages</th>
              <th>Agent chargé du traitement</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="lot in lots">
              <td>@{{ lot.num }}</td>
              <td>
                <div class="control">
                  <input class="input" type="number" v-model="lot.nbrDoc" required>
                </div>
              </td>

              <td>
                <div class="control">
                  <input class="input" type="number" v-model="lot.nbrPage" required>
                </div>
              </td>

              <td>
                <div class="select">
                  <select v-model="lot.user_id" id="">
                    @foreach ($users as $user)
                      <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                  </select>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </section>
      <footer class="modal-card-foot">
        <button class="button is-info is-outlined" @click.prevent="updateLot">Enregister</button>
        <button class="button" @click.prevent="showModalEdit = false">Annuler</button>
      </footer>
    </form>
  </div>
</div>
<!-- END MODAL EDIT -->
@endsection