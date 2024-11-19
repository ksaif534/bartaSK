<x-mail::message>
# Dear {{ $postAuthor->name }},

<x-mail::panel>
    {{ $user->name }} commented on your post. Please check the comment.
</x-mail::panel>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
