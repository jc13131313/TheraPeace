const express = require('express');
const bodyParser = require('body-parser');

const app = express();
const port = 3000;

app.use(bodyParser.json());

app.post('/updateLocation', (req, res) => {
    const { latitude, longitude } = req.body;
    console.log('Received location update:', { latitude, longitude });

    // You can save the location to a database or perform other actions here

    res.json({ message: 'Location received successfully.' });
});

app.listen(port, () => {
    console.log(`Server is running at http://localhost:${port}`);
});
