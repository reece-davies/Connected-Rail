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
    public class LOCATIONsController : ApiController
    {
        private Entities2 db = new Entities2();

        // GET: api/LOCATIONs
        public IQueryable<LOCATION> GetLOCATIONS()
        {
            db.Configuration.ProxyCreationEnabled = false;

            return db.LOCATIONS;
        }

        // GET: api/LOCATIONs/5
        [ResponseType(typeof(LOCATION))]
        public IHttpActionResult GetLOCATION(int id)
        {
            db.Configuration.ProxyCreationEnabled = false;

            LOCATION lOCATION = db.LOCATIONS.Find(id);
            if (lOCATION == null)
            {
                return NotFound();
            }

            return Ok(lOCATION);
        }

        // PUT: api/LOCATIONs/5
        [ResponseType(typeof(void))]
        public IHttpActionResult PutLOCATION(int id, LOCATION lOCATION)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            if (id != lOCATION.ID)
            {
                return BadRequest();
            }

            db.Entry(lOCATION).State = EntityState.Modified;

            try
            {
                db.SaveChanges();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!LOCATIONExists(id))
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

        // POST: api/LOCATIONs
        [ResponseType(typeof(LOCATION))]
        public IHttpActionResult PostLOCATION(LOCATION lOCATION)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            db.LOCATIONS.Add(lOCATION);

            try
            {
                db.SaveChanges();
            }
            catch (DbUpdateException)
            {
                if (LOCATIONExists(lOCATION.ID))
                {
                    return Conflict();
                }
                else
                {
                    throw;
                }
            }

            return CreatedAtRoute("DefaultApi", new { id = lOCATION.ID }, lOCATION);
        }

        // DELETE: api/LOCATIONs/5
        [ResponseType(typeof(LOCATION))]
        public IHttpActionResult DeleteLOCATION(int id)
        {
            LOCATION lOCATION = db.LOCATIONS.Find(id);
            if (lOCATION == null)
            {
                return NotFound();
            }

            db.LOCATIONS.Remove(lOCATION);
            db.SaveChanges();

            return Ok(lOCATION);
        }

        protected override void Dispose(bool disposing)
        {
            if (disposing)
            {
                db.Dispose();
            }
            base.Dispose(disposing);
        }

        private bool LOCATIONExists(int id)
        {
            return db.LOCATIONS.Count(e => e.ID == id) > 0;
        }
    }
}