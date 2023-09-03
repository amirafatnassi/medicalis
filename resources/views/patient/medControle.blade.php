@extends('layouat.layaoutPatient')
@section('contenu')
    <div class="card">
        <div class="card-header">{{ __('Select Specialties to Restrict') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('patient.medecins.storeSpecialties', $id_medecin) }}">@csrf
                <div class="form-group row">
                    <div class="col-md-12">
                        @foreach ($Specialites as $specialty)
                        <div class="form-check row">
                            <input class="form-check-input" type="checkbox" name="specialties[]" value="{{ $specialty->id }}" id="specialty{{ $specialty->id }}" 
                            {{ in_array($specialty->id, $restricted_specialties) ? 'checked' : '' }}>
                            <label class="form-check-label" for="specialty{{ $specialty->id }}">
                                {{ $specialty->lib }}
                            </label>
                        </div>
                        @endforeach
                        @error('specialties')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection