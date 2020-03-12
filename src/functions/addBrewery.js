import faunadb from 'faunadb';
import { Client } from '@googlemaps/google-maps-services-js';

const q = faunadb.query;
const client = new faunadb.Client({
  secret: process.env.FAUNADB_SERVER_SECRET,
});

const googleMapsClient = new Client({});

const getLatLng = address => new Promise((resolve, reject) => {
  const params = {
    address,
    key: process.env.VUE_APP_GOOGLE_MAPS_API_KEY,
  };

  googleMapsClient.geocode({ params })
    .then(({ data: { results, status } }) => {
      if (results.length === 0) {
        reject({
          requestResult: { statusCode: 404 },
          message: 'No results',
        });
      } else if (status !== 'OK') {
        reject({
          requestResult: { statusCode: 500 },
          message: 'Something went wrong.',
        });
      } else {
        const latLng = results[0].geometry.location;
        resolve(Object.keys(latLng).map(key => latLng[key]));
      }
    })
    .catch(({ response }) => {
      reject({
        requestResult: { statusCode: response.status },
        message: response.data.error_message,
      });
    });
});


export async function handler(event) {
  try {
    const data = JSON.parse(event.body);
    const latLng = await getLatLng(data.address);
    data.latLng = latLng;
    const response = await client.query(q.Create(q.Collection('Brewery'), { data }));

    return {
      statusCode: 200,
      body: JSON.stringify(response),
    };
  } catch (error) {

    return {
      statusCode: error.requestResult.statusCode,
      body: JSON.stringify(error),
    };
  }
}