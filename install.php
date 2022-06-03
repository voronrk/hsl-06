<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <title>Bot handler installer</title>
</head>
<body>

    <?php if (isset($_POST['key'])) {
        $key = $_POST['key'];
        $handlerURL = $_POST['handler'];

        $install = file_get_contents('https://api.telegram.org/bot' . $key . '/setWebhook?url=' . $handlerURL);
        $install_result = json_decode($install, true);
        echo "<pre>";
        print_r($install_result);
        echo "</pre>";
    } else { ?>
        <form class="section" method="POST" action="install.php">
            <div class="field">
                <label class="label">Bot token</label>
                <div class="control">
                    <input class="input" type="text" placeholder="Bot token" name="key">
                </div>
            </div>
            <div class="field">
                <label class="label">Bot handler</label>
                <div class="control">
                    <input class="input" type="text" placeholder="Bot handler" name="handler">
                </div>
            </div>
            <button type="submit" class="button is-primary">Install</button>
        </form>
    <?php } ?>    
</body>
</html>
