using System;
using System.Collections.Generic;
using System.Data;
using System.Data.Entity;
using System.Data.Entity.Infrastructure;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Web.Http;
using System.Web.Http.Cors;
using System.Web.Http.Description;
using API.Models;

namespace API.Controllers
{
    [EnableCors(origins: "*", headers: "*", methods: "*")] // tune to your needs
    [RoutePrefix("")]
    public class API_TOKENSController : ApiController
    {
        private Entities2 db = new Entities2();

        // GET: api/API_TOKENS
        public IQueryable<API_TOKENS> GetAPI_TOKENS()
        {
            db.Configuration.ProxyCreationEnabled = false;
            return db.API_TOKENS;
        }

        // GET: api/API_TOKENS/5
        [ResponseType(typeof(API_TOKENS))]
        public IHttpActionResult GetAPI_TOKENS(int id)
        {
            db.Configuration.ProxyCreationEnabled = false;

            API_TOKENS aPI_TOKENS = db.API_TOKENS.Find(id);
            if (aPI_TOKENS == null)
            {
                return NotFound();
            }

            return Ok(aPI_TOKENS);
        }

        // PUT: api/API_TOKENS/5
        [ResponseType(typeof(void))]
        public IHttpActionResult PutAPI_TOKENS(int id, API_TOKENS aPI_TOKENS)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            if (id != aPI_TOKENS.ID)
            {
                return BadRequest();
            }

            db.Entry(aPI_TOKENS).State = EntityState.Modified;

            try
            {
                db.SaveChanges();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!API_TOKENSExists(id))
                {
                    return NotFound();
                }
                else
                {
                    throw;
                }
            }

            return StatusCode(HttpStatusCode.NoContent);
        }

        // POST: api/API_TOKENS
        [ResponseType(typeof(API_TOKENS))]
        public IHttpActionResult PostAPI_TOKENS(API_TOKENS aPI_TOKENS)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            db.API_TOKENS.Add(aPI_TOKENS);

            try
            {
                db.SaveChanges();
            }
            catch (DbUpdateException)
            {
                if (API_TOKENSExists(aPI_TOKENS.ID))
                {
                    return Conflict();
                }
                else
                {
                    throw;
                }
            }

            return CreatedAtRoute("DefaultApi", new { id = aPI_TOKENS.ID }, aPI_TOKENS);
        }

        // DELETE: api/API_TOKENS/5
        [ResponseType(typeof(API_TOKENS))]
        public IHttpActionResult DeleteAPI_TOKENS(int id)
        {
            API_TOKENS aPI_TOKENS = db.API_TOKENS.Find(id);
            if (aPI_TOKENS == null)
            {
                return NotFound();
            }

            db.API_TOKENS.Remove(aPI_TOKENS);
            db.SaveChanges();

            return Ok(aPI_TOKENS);
        }

        protected override void Dispose(bool disposing)
        {
            if (disposing)
            {
                db.Dispose();
            }
            base.Dispose(disposing);
        }

        private bool API_TOKENSExists(int id)
        {
            return db.API_TOKENS.Count(e => e.ID == id) > 0;
        }
    }
}