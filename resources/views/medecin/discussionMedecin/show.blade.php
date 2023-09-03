@extends('layouat.layaoutMedecin')
@section('contenu')

<div class="row">
    <div class="col-lg-2 col-3">
        <ul class="timeline">
            <a href="{{url('/medecin/forum/create')}}" class="list-group-item list-group-item-action">
                <i data-feather="plus-circle" class="font-medium-3 mr-50"></i>
                <span class="align-middle">Nouvelle discussion</span>
            </a>
            <a href="{{url('/medecin/forum/recu')}}" class="list-group-item list-group-item-action">
                <i data-feather="mail" class="font-medium-3 mr-50"></i>
                <span class="align-middle">Discussions reçues</span>
            </a>
            <a href="{{url('/medecin/forum/envoye')}}" class="list-group-item list-group-item-action">
                <i data-feather="send" class="font-medium-3 mr-50"></i>
                <span class="align-middle">Envoyé</span>
            </a>

            <a href="{{url('/medecin/forum/cloture')}}" class="list-group-item list-group-item-action">
                <i data-feather="info" class="font-medium-3 mr-50"></i>
                <span class="align-middle">Messages Cloturés</span>
            </a>
            <a href="{{url('/medecin/forum/recucloture')}}" class="list-group-item list-group-item-action">
                <i data-feather="info" class="font-medium-3 mr-50"></i>
                <span class="align-middle">Discussions reçues cloturés</span>
            </a>
            <a href="{{url('/medecin/forum/envoyecloture')}}" class="list-group-item list-group-item-action">
                <i data-feather="info" class="font-medium-3 mr-50"></i>
                <span class="align-middle">Envoyé Cloturés</span>
            </a>
        </ul>
    </div>

    <div class="col-lg-10 col-9">
        <figure>
            <blockquote class="blockquote">
                <img src="{{asset('uploads/users/'.($d->emetteur->image??'user.png'))}}" class="round" height="30" width="30" alt="" />
                {{ $d->emetteur->prenom }} {{$d->emetteur->nom}}
                <i data-feather="arrow-right"></i>
                <img src="{{asset('uploads/users/'.($d->destinataire->image??'user.png'))}}" class="round" height="30" width="30" alt="" />
                {{ $d->destinataire->prenom }} {{$d->destinataire->nom}}
                :
                {{$d->type_courrier}}: {{$d->title}}
            </blockquote>
            <figcaption class="blockquote-footer">
                <cite title="Source Title"> {{date('d/m/Y H:i',strtotime($d->updated_at))}}</cite>
                <p id="cloture" hidden>{{$d->cloture}}</p>
            </figcaption>
        </figure>

        @foreach($d->replies as $r)
        <div class="card mb-3">
            <div class="card-header">
                <div class="col-6">
                    <img src="{{asset('uploads/users/'.($r->emetteur->image??'user.png'))}}" class="round" height="30" width="30" alt="" />
                    {{$r->emetteur->prenom}} {{$r->emetteur->nom}}
                </div>
                <div class="col-3"><b>{{date('d/m/Y H:i',strtotime($r->created_at))}}</b></div>
            </div>
            <div class="card-body">
                <div class="card-text">
                    <p>{!!$r->content!!}</p>
                    @if($r->files->count()!=0)
                    @foreach($r->files as $f)
                    @if($f->idReply==$r->id)
                    <div class="row">
                        <a href="{{url('/public/uploads/courrier/'.$f->downloads)}}"><i data-feather="paperclip"></i> {{$f->downloads}}</a>
                    </div>
                    @endif
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
        @endforeach

        @if ($d->cloture)
        <p class="text-warning">Cette discussion a été clôturée. Vous ne pouvez pas répondre.</p>
        @else
        <div class="card">
            @if ($errors->any())
            <div class="alert alert-danger col-12">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form method="POST" action="{{url('medecin/forum/reply',['id'=>$d->id])}}" enctype="multipart/form-data"> @csrf
                <div class="card-header">
                    <div class="card-title">Réponse</div>
                </div>
                <div class="card-body row">
                    <div class="col-12">
                        <textarea name="reply" id="reply" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="col-12" id="pieceJointe">
                        <label for="file">Pièce jointe:</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="filesup[]" class="custom-file-input" multiple id="fileup">
                                <label class="custom-file-label" id="filename">Choisir fichier</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" id="b_submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-reply-fill" viewBox="0 0 16 16">
                            <path d="M5.921 11.9 1.353 8.62a.719.719 0 0 1 0-1.238L5.921 4.1A.716.716 0 0 1 7 4.719V6c1.5 0 6 0 7 8-2.5-4.5-7-4-7-4v1.281c0 .56-.606.898-1.079.62z" />
                        </svg>
                        <span class="align-middle">Répondre</span>
                    </button>
                    <a type="submit" class="btn btn-primary" href="{{url('/medecin/forum/cloturer',['id'=>$d->id])}}" id="b_cloture">
                        <i data-feather="lock"></i>
                        <span class="align-middle">Cloturer</span>
                    </a>
                </div>
            </form>
        </div>
        @endif

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                $("#fileup").change(function() {
                    let filenames = Array.from(this.files).map(file => file.name).join(", ");
                    $("#filename").text(filenames);
                });

                CKEDITOR.replace('reply');
            });
        </script>
    </div>
</div>
@endsection