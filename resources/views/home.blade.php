<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-600 p-4 text-white">
        <div class="container mx-auto flex justify-between">
            <span class="text-xl font-bold">{{ config('app.name') }}</span>
        </div>
    </nav>

    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-semibold text-center">API Documentation</h1>
        <p class="text-gray-600 mt-2 text-center">Here is a list of available API endpoints with descriptions and examples.</p>

        <table class="table-auto w-full mt-6 bg-white shadow-md rounded-lg">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="px-4 py-2 text-left">Route</th>
                    <th class="px-4 py-2 text-left">Description</th>
                    <th class="px-4 py-2 text-left">Example</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-t">
                    <td class="px-4 py-2">GET /v1/check</td>
                    <td class="px-4 py-2">Returns the status of the API.</td>
                    <td class="px-4 py-2"><code>/v1/check</code></td>
                </tr>
                <tr class="border-t">
                    <td class="px-4 py-2">GET /v1/password</td>
                    <td class="px-4 py-2">Generates a random password with a given length.</td>
                    <td class="px-4 py-2"><code>/v1/password?length=16</code></td>
                </tr>
                <tr class="border-t">
                    <td class="px-4 py-2">GET /v1/limit</td>
                    <td class="px-4 py-2">Limits a string to a specific number of characters.</td>
                    <td class="px-4 py-2"><code>/v1/limit?text=HelloWorld&length=5</code></td>
                </tr>
                <tr class="border-t">
                    <td class="px-4 py-2">GET /v1/slug/{text}</td>
                    <td class="px-4 py-2">Converts a string into a URL-friendly slug.</td>
                    <td class="px-4 py-2"><code>/v1/slug/Hello World</code></td>
                </tr>
                <tr class="border-t">
                    <td class="px-4 py-2">GET /v1/camel/{text}</td>
                    <td class="px-4 py-2">Converts a string to camel case.</td>
                    <td class="px-4 py-2"><code>/v1/camel/hello world</code></td>
                </tr>
                <tr class="border-t">
                    <td class="px-4 py-2">GET /v1/kebab/{text}</td>
                    <td class="px-4 py-2">Converts a string to kebab case.</td>
                    <td class="px-4 py-2"><code>/v1/kebab/hello world</code></td>
                </tr>
                <tr class="border-t">
                    <td class="px-4 py-2">GET /v1/title/{text}</td>
                    <td class="px-4 py-2">Converts a string to title case.</td>
                    <td class="px-4 py-2"><code>/v1/title/hello world</code></td>
                </tr>
                <tr class="border-t">
                    <td class="px-4 py-2">GET /v1/snake/{text}</td>
                    <td class="px-4 py-2">Converts a string to snake case.</td>
                    <td class="px-4 py-2"><code>/v1/snake/hello world</code></td>
                </tr>
                <tr class="border-t">
                    <td class="px-4 py-2">GET /v1/generate-qr</td>
                    <td class="px-4 py-2">Generates a QR code for a given text.</td>
                    <td class="px-4 py-2"><code>/v1/generate-qr?text=HelloWorld&size=300</code></td>
                </tr>
                <tr class="border-t">
                    <td class="px-4 py-2">GET /v1/validate-email/{email}</td>
                    <td class="px-4 py-2">Validates if an email is correctly formatted.</td>
                    <td class="px-4 py-2"><code>/v1/validate-email/test@example.com</code></td>
                </tr>
                <tr class="border-t">
                    <td class="px-4 py-2">GET /v1/uuid</td>
                    <td class="px-4 py-2">Generates a UUID.</td>
                    <td class="px-4 py-2"><code>/v1/uuid</code></td>
                </tr>
                <tr class="border-t">
                    <td class="px-4 py-2">GET /v1/datetime</td>
                    <td class="px-4 py-2">Returns the current datetime.</td>
                    <td class="px-4 py-2"><code>/v1/datetime</code></td>
                </tr>
                <tr class="border-t">
                    <td class="px-4 py-2">GET /v1/time-diff</td>
                    <td class="px-4 py-2">Returns the difference between a given date and now in a human-readable format.</td>
                    <td class="px-4 py-2"><code>/v1/time-diff?date=2022-01-01</code></td>
                </tr>
                <tr class="border-t">
                    <td class="px-4 py-2">GET /v1/time-diff-es</td>
                    <td class="px-4 py-2">Returns the difference between a given date and now in Spanish.</td>
                    <td class="px-4 py-2"><code>/v1/time-diff-es?date=2022-01-01</code></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
