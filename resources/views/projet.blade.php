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
    <li class="is-active"><a href="#" aria-current="page">Gestion des projets</a></li>
  </ul>
</nav>

<!-- Main container -->
<nav class="level">
  <!-- Left side -->
  <div class="level-left">
    <div class="level-item">
      <p class="subtitle is-5">
        <strong>{{ count($projets) }}</strong> projet(s)
      </p>
    </div>
    <div class="level-item">
      <form action="{{ route('posts.search') }}" method="get">
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
      <a class="button is-light" @click="showModal = true">Ajouter un projet</a>
    </div>
  </div>
</nav>

<!-- TABLE -->
<div class="columns is-centered">
  <table class="table">
    <thead>
      <tr>
        <th>Nom de projet</th>
        <th>Chef de projet</th>
        <th>Nbr. de lots</th>
        <th>Description</th>
        <th>Status</th>
        <th>Action</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($projets as $projet)
        <tr>
          <td>{{ $projet->name }}</td>
          <td>{{ $projet->user->name }}</td>
          <td>{{ $projet->nbrLot }}</td>
          <td>{{ $projet->description }}</td>
          <td>
            @if ($projet->completed)
              <span class="tag is-rounded is-primary">Terminé</span>
            @else
              <span class="tag is-rounded is-warning">Non terminé</span>
            @endif
          </td>
          <td><a href="{{ route('projets.show', $projet) }}" class="tag is-info">Voir plus</i></a></td>
          <td>
            <a href="" class="tag is-delete" onclick="event.preventDefault();
                                                          document.getElementById('{{ $projet->id }}').submit();"></a>

            <form id="{{ $projet->id }}" action="{{ route('projets.destroy', $projet) }}" method="post">
              {{ method_field('DELETE') }}
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

{{ $projets->links() }}


<!-- MODAL ADD -->
<div class="modal is-active" v-if="showModal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Ajouter un projet</p>
      <button class="delete" aria-label="close" @click="showModal = false"></button>
    </header>
    <form action="{{ route('projets.store') }}" method="post">
      {{ csrf_field() }}

      <section class="modal-card-body">
        <div class="field">
          <label class="label">Nom du projet</label>
          <div class="control">
            <input class="input" type="text" name="name" placeholder="Saisir un nom" required>
          </div>
        </div>

        <div class="field">
          <label class="label">Nombre de lots</label>
          <div class="control">
            <input class="input" type="number" name="nbrLot" placeholder="Saisir un nombre" required>
          </div>
        </div>

        <div class="field">
          <label class="label">Description (facultatif)</label>
          <div class="control">
            <textarea class="textarea is-primary" type="text" name="description" placeholder="Donner une description du projet"></textarea>
          </div>
        </div>

        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
      </section>
      <footer class="modal-card-foot">
        <button type="submit" class="button is-primary">Ajouter</button>
        <button class="button" @click.prevent="showModal = false">Annuler</button>
      </footer>
    </form>
  </div>
</div>
<!-- END MODAL ADD -->
@endsection