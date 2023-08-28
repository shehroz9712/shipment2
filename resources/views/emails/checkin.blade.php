<x-mail::message>
    # Check-in Notification

    Hello admin

    {{ $userName }}, have successfully checked in at {{ $attendance->check_in_time }}.

    Thank you for using our system.



    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
