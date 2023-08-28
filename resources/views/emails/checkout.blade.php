<x-mail::message>
    # Check-out Notification

    Hello admin,

    {{ $userName }} have successfully checked out at {{ $attendance->check_out_time }}.

    Thank you for using our system.


    regard,<br>
    {{ config('app.name') }}
</x-mail::message>
