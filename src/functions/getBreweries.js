import faunadb from 'faunadb';

const q = faunadb.query;
const client = new faunadb.Client({
  secret: process.env.FAUNADB_SERVER_SECRET,
});

export async function handler() {
  try {
    const breweries = [];
    const helper = await client.paginate(q.Match(q.Index('all_breweries')));

    await helper.each(page => {
      const mapped = page.map(([_fid, id, name, street, city, state, lat, lng, website]) => {
        const address = [street, city, state].join(', ');
        const latLng = [lat, lng];
        const record = { name, address, city, state, latLng, website };
        return record;
      });

      breweries.push(...mapped);
    });


    return {
      statusCode: 200,
      body: JSON.stringify(breweries),
    };

  } catch (error) {
    return {
      statusCode: 500,
      body: 'Error',
    };
  }
}