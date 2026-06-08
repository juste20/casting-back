<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8"></head>
<body style="font-family: Inter, Arial, sans-serif; background: #0a0a0a; color: #fff; padding: 40px;">
    <div style="max-width: 600px; margin: 0 auto; background: #141414; border-radius: 16px; padding: 32px; border: 1px solid rgba(255,255,255,0.06);">

        <div style="text-align: center; margin-bottom: 24px;">
            <span style="font-size: 22px; font-weight: 900; color: #fff;">CASTING<span style="color: #e50914;">.NET</span></span>
        </div>

        @if($action === 'approved')
            <!-- FRANÇAIS -->
            <h1 style="font-size: 20px; font-weight: 700; margin: 0 0 8px; color: #34d399;">Casting approuve !</h1>
            <p style="color: #9ca3af; line-height: 1.6; margin: 0 0 4px;">Bonjour,</p>
            <p style="color: #9ca3af; line-height: 1.6; margin: 0 0 20px;">
                Votre casting <strong style="color: #fff;">{{ $casting->title }}</strong> a ete approuve par notre equipe.
                Il sera visible sur la plateforme et les profils correspondants seront informes.
            </p>
            <hr style="border:none;border-top:1px solid rgba(255,255,255,0.06);margin:20px 0;">
            <!-- ENGLISH -->
            <h1 style="font-size: 20px; font-weight: 700; margin: 0 0 8px; color: #34d399;">Casting approved!</h1>
            <p style="color: #9ca3af; line-height: 1.6; margin: 0 0 4px;">Hello,</p>
            <p style="color: #9ca3af; line-height: 1.6; margin: 0 0 20px;">
                Your casting <strong style="color: #fff;">{{ $casting->title }}</strong> has been approved by our team.
                It will be visible on the platform and matching profiles will be notified.
            </p>
        @else
            <!-- FRANÇAIS -->
            <h1 style="font-size: 20px; font-weight: 700; margin: 0 0 8px; color: #e50914;">Casting rejete</h1>
            <p style="color: #9ca3af; line-height: 1.6; margin: 0 0 4px;">Bonjour,</p>
            <p style="color: #9ca3af; line-height: 1.6; margin: 0 0 20px;">
                Votre casting <strong style="color: #fff;">{{ $casting->title }}</strong> n'a pas ete approuve.
                Vous pouvez corriger les informations et le soumettre a nouveau.
            </p>
            <hr style="border:none;border-top:1px solid rgba(255,255,255,0.06);margin:20px 0;">
            <!-- ENGLISH -->
            <h1 style="font-size: 20px; font-weight: 700; margin: 0 0 8px; color: #e50914;">Casting rejected</h1>
            <p style="color: #9ca3af; line-height: 1.6; margin: 0 0 4px;">Hello,</p>
            <p style="color: #9ca3af; line-height: 1.6; margin: 0 0 20px;">
                Your casting <strong style="color: #fff;">{{ $casting->title }}</strong> has not been approved.
                Please review and resubmit with the necessary corrections.
            </p>
        @endif

        <div style="background: rgba(255,255,255,0.03); border-radius: 10px; padding: 16px; margin-bottom: 20px; border: 1px solid rgba(255,255,255,0.05);">
            <p style="margin: 0 0 4px; color: #808080; font-size: 12px;">Titre / Title</p>
            <p style="margin: 0 0 12px; color: #fff; font-weight: 600;">{{ $casting->title }}</p>
            <p style="margin: 0 0 4px; color: #808080; font-size: 12px;">Email promoteur / Promoter email</p>
            <p style="margin: 0 0 12px; color: #fff;">{{ $casting->promoter_email }}</p>
            <p style="margin: 0 0 4px; color: #808080; font-size: 12px;">Telephone / Phone</p>
            <p style="margin: 0; color: #fff;">{{ $casting->promoter_phone ?? '-' }}</p>
        </div>

        <p style="color: #808080; font-size: 12px; text-align: center; margin: 0;">
            &copy; 2026 CASTING.NET - Plateforme de mise en relation / Talent matching platform
        </p>

    </div>
</body>
</html>
