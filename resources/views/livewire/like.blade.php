@if($like->isLiked(auth()->id(),$course_id)) {{--he was Liked --}}
    <form wire:submit.prevent='disLikes' class="d-inline">{{--DisLiked Form--}}
        <input type="hidden" name="course_id" value="{{ $course_id }}" wire:model='course_id'>
        <button type="submit" class="text-primary btn d-inline"><i class="fs-3 bi bi-hand-thumbs-up-fill"></i>{{ $like->countOfLike($course_id) }}</button>
    </form>
@else{{--he was Liked --}}
    <form wire:submit.prevent='likes' class="d-inline">{{--Liked Form--}}
        <input type="hidden" name="course_id" value="{{ $course_id }}" wire:model='course_id'>
        <button type="submit" class="text-primary btn d-inline"><i class="fs-3 bi bi-hand-thumbs-up"></i>{{ $like->countOfLike($course_id) }}</button>
    </form>


@endif



