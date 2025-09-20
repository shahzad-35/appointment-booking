<p>Hello {{ $booking->user->name }},</p>
<p>Your booking for {{ $booking->service->name }} has been confirmed.</p>
<p>Date: {{ $booking->slot->start_time->format('M d, H:i') }}</p>
<p>Thank you for choosing us!</p>
<?php
