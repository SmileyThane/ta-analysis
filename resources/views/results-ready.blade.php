<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your TA Analysis Results Are Ready!</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #6366f1, #ec4899); color: white; padding: 30px 20px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { background: white; padding: 30px; border: 1px solid #e5e5e5; border-top: none; }
        .footer { background: #f8f9fa; padding: 20px; text-align: center; border-radius: 0 0 8px 8px; font-size: 14px; color: #6c757d; }
        .button { display: inline-block; background: #6366f1; color: white; padding: 12px 24px; text-decoration: none; border-radius: 6px; font-weight: bold; margin: 20px 0; }
        .highlight-box { background: #f8f9ff; border-left: 4px solid #6366f1; padding: 20px; margin: 20px 0; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>🎉 Your TA Analysis is Complete!</h1>
        <p>Comprehensive Target Audience Insights Ready for Download</p>
    </div>

    <div class="content">
        <p>Hi {{ $taaRequest->name }},</p>

        <p>Great news! Your Target Audience Analysis has been completed and is ready for download. Our team has conducted a comprehensive analysis of your product and market to deliver actionable insights.</p>

        <div class="highlight-box">
            <h3>📊 Your Analysis Includes:</h3>
            <ul>
                <li><strong>Detailed Customer Personas</strong> - Demographics, psychographics, and behavioral patterns</li>
                <li><strong>Pain Point Analysis</strong> - Key problems your audience faces</li>
                <li><strong>Boolean Search Queries</strong> - Precise targeting for social media and search</li>
                <li><strong>Interview Questions</strong> - Grok-style questions to validate your findings</li>
                <li><strong>Platform Insights</strong> - Reddit, LinkedIn, and Quora conversation analysis</li>
                <li><strong>Actionable Recommendations</strong> - Next steps for your marketing strategy</li>
            </ul>
        </div>

        <p><strong>Request Details:</strong></p>
        <ul>
            <li>Request ID: #{{ $taaRequest->id }}</li>
            <li>Analysis Date: {{ $taaRequest->updated_at->format('F j, Y') }}</li>
            <li>Product Analyzed: {{ Str::limit($taaRequest->description, 100) }}</li>
        </ul>

        <p>The complete analysis has been attached to this email as a PDF file. You can also access it anytime from your account dashboard.</p>

        <div style="text-align: center;">
            <a href="{{ route('home') }}" class="button">Visit Our Website</a>
        </div>

        <p>If you have any questions about your analysis or need clarification on any of the recommendations, please don't hesitate to reach out to our team.</p>

        <p>We're excited to see how you'll use these insights to grow your business!</p>

        <p>Best regards,<br>
            <strong>The TA Analysis Engine Team</strong></p>
    </div>

    <div class="footer">
        <p>This email was sent to {{ $taaRequest->email }} regarding your TA Analysis request #{{ $taaRequest->id }}.</p>
        <p>© {{ date('Y') }} TA Analysis Engine. All rights reserved.</p>
    </div>
</div>
</body>
</html>
