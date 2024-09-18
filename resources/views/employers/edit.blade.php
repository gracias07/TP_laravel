@extends('layouts.template')


@section('content')
    <h1 class="app-page-title">Employers</h1>
    <hr class="mb-4">
    <div class="row g-4 settings-section">
        <div class="col-12 col-md-4">
            <h3 class="section-title">Edition</h3>
            <div class="section-intro">Editer un employé</div>
        </div>
        <div class="col-12 col-md-8">
            <div class="app-card app-card-settings shadow-sm p-4" method="POST">


                <form action="{{ route('employers.update', $employer->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="departement_id" class="form-label">Département</label>
                        <select name="departement_id" id="departement_id" class="form-control" required>
                            @foreach ($departements as $departement)
                                <option value="{{ $departement->id }}"
                                    {{ $employer->departement_id === $departement->id ? 'selected' : ''}}>
                                    {{ $departement->name }}</option>
                            @endforeach
                        </select>
                        @error('departement_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" required value="{{ $employer->nom}}">
                        @error('nom')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="prenom" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" required value="{{ $employer->prenom }}">
                        @error('prenom')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required value="{{ $employer->email }}">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="contact" class="form-label">Contact</label>
                        <input type="text" class="form-control" id="contact" name="contact" required value="{{ $employer->contact}}">
                        @error('contact')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="montant_journalier" class="form-label">Montant journalier</label>
                        <input type="number" class="form-control" id="montant_journalier" name="montant_journalier" required value="{{ $employer->montant_journalier }}">
                        @error('montant_journalier')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn app-btn-primary">Mettre à jour</button>
                </form>

                    </div><!--//app-card-body-->

            </div><!--//app-card-->
        </div>
    </div><!--//row-->
    <!--//row-->
@endsection
