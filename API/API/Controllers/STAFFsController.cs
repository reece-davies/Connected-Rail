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
    public class STAFFsController : ApiController
    {
        private Entities2 db = new Entities2();

        // GET: api/STAFFs
        public IQueryable<STAFF> GetSTAFFs()
        {
            db.Configuration.ProxyCreationEnabled = false;
            return db.STAFFs;
        }

        // GET: api/STAFFs/5
        [ResponseType(typeof(STAFF))]
        public IHttpActionResult GetSTAFF(int id)
        {
            db.Configuration.ProxyCreationEnabled = false;

            STAFF sTAFF = db.STAFFs.Find(id);
            if (sTAFF == null)
            {
                return NotFound();
            }

            return Ok(sTAFF);
        }

        // PUT: api/STAFFs/5
        [ResponseType(typeof(void))]
        public IHttpActionResult PutSTAFF(int id, STAFF sTAFF)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            if (id != sTAFF.ID)
            {
                return BadRequest();
            }

            db.Entry(sTAFF).State = EntityState.Modified;

            try
            {
                db.SaveChanges();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!STAFFExists(id))
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

        // POST: api/STAFFs
        [ResponseType(typeof(STAFF))]
        public IHttpActionResult PostSTAFF(STAFF sTAFF)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            db.STAFFs.Add(sTAFF);

            try
            {
                db.SaveChanges();
            }
            catch (DbUpdateException)
            {
                if (STAFFExists(sTAFF.ID))
                {
                    return Conflict();
                }
                else
                {
                    throw;
                }
            }

            return CreatedAtRoute("DefaultApi", new { id = sTAFF.ID }, sTAFF);
        }

        // DELETE: api/STAFFs/5
        [ResponseType(typeof(STAFF))]
        public IHttpActionResult DeleteSTAFF(int id)
        {
            STAFF sTAFF = db.STAFFs.Find(id);
            if (sTAFF == null)
            {
                return NotFound();
            }

            db.STAFFs.Remove(sTAFF);
            db.SaveChanges();

            return Ok(sTAFF);
        }

        protected override void Dispose(bool disposing)
        {
            if (disposing)
            {
                db.Dispose();
            }
            base.Dispose(disposing);
        }

        private bool STAFFExists(int id)
        {
            return db.STAFFs.Count(e => e.ID == id) > 0;
        }
    }
}