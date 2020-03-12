import faunadb from 'faunadb';

const q = faunadb.query;
const client = new faunadb.Client({
  secret: process.env.FAUNADB_SERVER_SECRET,
});

export async function handler() {
  try {
    const response = await client.query(q.Paginate(q.Match(q.Index('allBreweries'))));
    const refs = response.data;
    const getAllQuery = refs.map(ref => q.Get(ref));
    const allBreweries = await client.query(getAllQuery);

    return {
      statusCode: 200,
      body: JSON.stringify(allBreweries),
    };

  } catch (error) {
    return {
      statusCode: 500,
      body: 'Error',
    };
  }
}