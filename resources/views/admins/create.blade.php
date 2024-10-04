@extends('layouts.template')


@section('content')
    <h1 class="app-page-title">Administrateurs</h1>
    <hr class="mb-4">
    <div class="row g-4 settings-section">
        <div class="col-12 col-md-4">
            <h3 class="section-title">Ajout </h3>
            <div class="section-intro">Ajoutez ici un nouveau administrateur</div>
        </div>
        <div class="col-12 col-md-8">
            <div class="app-card app-card-settings shadow-sm p-4" method="POST">


                <form action="{{ route('administrateurs.store') }}" method="POST">
                    @csrf


                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom complet</label>
                        <input type="text" class="form-control" id="nom" name="name" required value="{{ old('name') }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>



                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required value="{{ old('email') }}">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>




                    <button type="submit" class="btn app-btn-primary">Enregistrer</button>
                </form>

                    </div><!--//app-card-body-->

            </div><!--//app-card-->
        </div>
    </div><!--//row-->
    <!--//row-->
@endsection
