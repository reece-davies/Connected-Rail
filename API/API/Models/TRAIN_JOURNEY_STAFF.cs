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
    
    public partial class TRAIN_JOURNEY_STAFF
    {
        public int ID { get; set; }
        public Nullable<int> STAFF_ID { get; set; }
        public Nullable<int> JOURNEY_ID { get; set; }
    
        public virtual STAFF STAFF { get; set; }
        public virtual TRAIN_JOURNEY TRAIN_JOURNEY { get; set; }
    }
}
