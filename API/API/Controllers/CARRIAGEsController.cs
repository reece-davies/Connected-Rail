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
    public class CARRIAGEsController : ApiController
    {
        private Entities2 db = new Entities2();

        // GET: api/CARRIAGEs
        public IQueryable<CARRIAGE> GetCARRIAGES()
        {
            db.Configuration.ProxyCreationEnabled = false;
            return db.CARRIAGES;
        }

        // GET: api/CARRIAGEs/5
        [ResponseType(typeof(CARRIAGE))]
        public IHttpActionResult GetCARRIAGE(int id)
        {
            db.Configuration.ProxyCreationEnabled = false;

            CARRIAGE cARRIAGE = db.CARRIAGES.Find(id);
            if (cARRIAGE == null)
            {
                return NotFound();
            }

            return Ok(cARRIAGE);
        }

        // PUT: api/CARRIAGEs/5
        [ResponseType(typeof(void))]
        public IHttpActionResult PutCARRIAGE(int id, CARRIAGE cARRIAGE)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            if (id != cARRIAGE.ID)
            {
                return BadRequest();
            }

            db.Entry(cARRIAGE).State = EntityState.Modified;

            try
            {
                db.SaveChanges();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!CARRIAGEExists(id))
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

        // POST: api/CARRIAGEs
        [ResponseType(typeof(CARRIAGE))]
        public IHttpActionResult PostCARRIAGE(CARRIAGE cARRIAGE)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            db.CARRIAGES.Add(cARRIAGE);

            try
            {
                db.SaveChanges();
            }
            catch (DbUpdateException)
            {
                if (CARRIAGEExists(cARRIAGE.ID))
                {
                    return Conflict();
                }
                else
                {
                    throw;
                }
            }

            return CreatedAtRoute("DefaultApi", new { id = cARRIAGE.ID }, cARRIAGE);
        }

        // DELETE: api/CARRIAGEs/5
        [ResponseType(typeof(CARRIAGE))]
        public IHttpActionResult DeleteCARRIAGE(int id)
        {
            CARRIAGE cARRIAGE = db.CARRIAGES.Find(id);
            if (cARRIAGE == null)
            {
                return NotFound();
            }

            db.CARRIAGES.Remove(cARRIAGE);
            db.SaveChanges();

            return Ok(cARRIAGE);
        }

        protected override void Dispose(bool disposing)
        {
            if (disposing)
            {
                db.Dispose();
            }
            base.Dispose(disposing);
        }

        private bool CARRIAGEExists(int id)
        {
            return db.CARRIAGES.Count(e => e.ID == id) > 0;
        }
    }
}