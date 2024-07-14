<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sent Message Status</title>
</head>
<body>
    <div>
        <h1>Sent Message Status</h1>
        @if ($status && isset($status['id']))
            <p><strong>Message ID:</strong> {{ $status['id'] }}</p>
            <p><strong>Message Status:</strong> {{ $status['message_status'] }}</p>
            <p><strong>Status:</strong> {{ $status['status'] ? 'true' : 'false' }}</p>
        @else
            <p>Error retrieving or invalid message status data.</p>
        @endif
    </div>
</body>
</html>
