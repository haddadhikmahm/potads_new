<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eee; border-radius: 10px; }
        .header { background-color: #1E88E5; color: white; padding: 20px; border-radius: 10px 10px 0 0; text-align: center; }
        .content { padding: 20px; }
        .footer { font-size: 12px; color: #777; text-align: center; margin-top: 20px; }
        .label { font-weight: bold; color: #0D47A1; }
        .message-box { background-color: #f9f9f9; padding: 15px; border-radius: 5px; border-left: 4px solid #FFC107; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Pesan Baru dari Website POTADS</h2>
        </div>
        <div class="content">
            <p>Halo Admin,</p>
            <p>Anda menerima pesan baru dari formulir kontak di website.</p>
            
            <p><span class="label">Nama:</span> {{ $msg->name }}</p>
            <p><span class="label">Email:</span> {{ $msg->email }}</p>
            <p><span class="label">Subjek:</span> {{ $msg->subject }}</p>
            
            <p><span class="label">Isi Pesan:</span></p>
            <div class="message-box">
                {{ $msg->message }}
            </div>
            
            <p>Silakan segera ditindaklanjuti.</p>
        </div>
        <div class="footer">
            <p>Email ini dikirim otomatis dari sistem POTADS Jabar.</p>
        </div>
    </div>
</body>
</html>
