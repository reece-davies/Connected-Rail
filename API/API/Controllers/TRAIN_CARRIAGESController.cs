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
    public class TRAIN_CARRIAGESController : ApiController
    {
        private Entities2 db = new Entities2();

        // GET: api/TRAIN_CARRIAGES
        public IQueryable<TRAIN_CARRIAGES> GetTRAIN_CARRIAGES()
        {
            db.Configuration.ProxyCreationEnabled = false;
            return db.TRAIN_CARRIAGES;
        }

        // GET: api/TRAIN_CARRIAGES/5
        [ResponseType(typeof(TRAIN_CARRIAGES))]
        public IHttpActionResult GetTRAIN_CARRIAGES(int id)
        {
            db.Configuration.ProxyCreationEnabled = false;

            TRAIN_CARRIAGES tRAIN_CARRIAGES = db.TRAIN_CARRIAGES.Find(id);
            if (tRAIN_CARRIAGES == null)
            {
                return NotFound();
            }

            return Ok(tRAIN_CARRIAGES);
        }

        // PUT: api/TRAIN_CARRIAGES/5
        [ResponseType(typeof(void))]
        public IHttpActionResult PutTRAIN_CARRIAGES(int id, TRAIN_CARRIAGES tRAIN_CARRIAGES)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            if (id != tRAIN_CARRIAGES.ID)
            {
                return BadRequest();
            }

            db.Entry(tRAIN_CARRIAGES).State = EntityState.Modified;

            try
            {
                db.SaveChanges();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!TRAIN_CARRIAGESExists(id))
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

        // POST: api/TRAIN_CARRIAGES
        [ResponseType(typeof(TRAIN_CARRIAGES))]
        public IHttpActionResult PostTRAIN_CARRIAGES(TRAIN_CARRIAGES tRAIN_CARRIAGES)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            db.TRAIN_CARRIAGES.Add(tRAIN_CARRIAGES);

            try
            {
                db.SaveChanges();
            }
            catch (DbUpdateException)
            {
                if (TRAIN_CARRIAGESExists(tRAIN_CARRIAGES.ID))
                {
                    return Conflict();
                }
                else
                {
                    throw;
                }
            }

            return CreatedAtRoute("DefaultApi", new { id = tRAIN_CARRIAGES.ID }, tRAIN_CARRIAGES);
        }

        // DELETE: api/TRAIN_CARRIAGES/5
        [ResponseType(typeof(TRAIN_CARRIAGES))]
        public IHttpActionResult DeleteTRAIN_CARRIAGES(int id)
        {
            TRAIN_CARRIAGES tRAIN_CARRIAGES = db.TRAIN_CARRIAGES.Find(id);
            if (tRAIN_CARRIAGES == null)
            {
                return NotFound();
            }

            db.TRAIN_CARRIAGES.Remove(tRAIN_CARRIAGES);
            db.SaveChanges();

            return Ok(tRAIN_CARRIAGES);
        }

        protected override void Dispose(bool disposing)
        {
            if (disposing)
            {
                db.Dispose();
            }
            base.Dispose(disposing);
        }

        private bool TRAIN_CARRIAGESExists(int id)
        {
            return db.TRAIN_CARRIAGES.Count(e => e.ID == id) > 0;
        }
    }
}