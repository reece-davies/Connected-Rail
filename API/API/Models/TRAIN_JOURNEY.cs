//------------------------------------------------------------------------------
// <auto-generated>
//     This code was generated from a template.
//
//     Manual changes to this file may cause unexpected behavior in your application.
//     Manual changes to this file will be overwritten if the code is regenerated.
// </auto-generated>
//------------------------------------------------------------------------------

namespace API.Models
{
    using System;
    using System.Collections.Generic;
    
    public partial class TRAIN_JOURNEY
    {
        [System.Diagnostics.CodeAnalysis.SuppressMessage("Microsoft.Usage", "CA2214:DoNotCallOverridableMethodsInConstructors")]
        public TRAIN_JOURNEY()
        {
            this.BOOKINGS = new HashSet<BOOKING>();
            this.TRAIN_JOURNEY_STAFF = new HashSet<TRAIN_JOURNEY_STAFF>();
        }
    
        public int ID { get; set; }
        public decimal JOURNEY_COST { get; set; }
        public Nullable<int> ARRIVAL_LOCATION_ID { get; set; }
        public Nullable<int> DEPARTURE_LOCATION_ID { get; set; }
    
        [System.Diagnostics.CodeAnalysis.SuppressMessage("Microsoft.Usage", "CA2227:CollectionPropertiesShouldBeReadOnly")]
        public virtual ICollection<BOOKING> BOOKINGS { get; set; }
        public virtual LOCATION LOCATION { get; set; }
        public virtual PASSENGER PASSENGER { get; set; }
        [System.Diagnostics.CodeAnalysis.SuppressMessage("Microsoft.Usage", "CA2227:CollectionPropertiesShouldBeReadOnly")]
        public virtual ICollection<TRAIN_JOURNEY_STAFF> TRAIN_JOURNEY_STAFF { get; set; }
    }
}