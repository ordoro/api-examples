package main

import (
	"encoding/json"
	"io/ioutil"
	"log"
	"net/http"
	"os"
	"time"
)

func main() {
	req, err := http.NewRequest("GET", "https://api.ordoro.com/company/", nil)
	if err != nil {
		log.Printf("Error encountered building request: %v", err)
	}

	req.SetBasicAuth(os.Getenv("ordoro_username"), os.Getenv("ordoro_password"))
	resp, err := http.DefaultClient.Do(req)
	if err != nil {
		log.Printf("Error encountered in sending request: %v", err)
	}
	defer resp.Body.Close()

	contents, err := ioutil.ReadAll(resp.Body)
	if err != nil {
		log.Printf("Error reading response from server: %v", err)
	}

	c := Company{}
	json.Unmarshal(contents, &c)

	log.Printf("%+v\n", c)
}

type PaymentDetails struct {
	Last4            string `json:"last4"`
	Brand            string `json:"brand"`
	ExpMonth         int    `json:"exp_month"`
	StripeCustomerID string `json:"stripe_customer_id"`
	ExpYear          int    `json:"exp_year"`
}

type Company struct {
	Deactivated       time.Time      `json:"deactivated"`
	ShipperCurrency   string         `json:"shipper_currency"`
	Activated         string         `json:"activated"`
	ID                int            `json:"id"`
	Link              string         `json:"_link"`
	Email             string         `json:"email"`
	Website           string         `json:"website"`
	Fax               string         `json:"fax"`
	MailSender        string         `json:"mail_sender"`
	Phone             string         `json:"phone"`
	Plan              string         `json:"plan"`
	Address           string         `json:"address"`
	Locked            bool           `json:"locked"`
	Name              string         `json:"name"`
	Created           string         `json:"created"`
	Footer            string         `json:"footer"`
	AutosyncFrequency string         `json:"autosync_frequency"`
	Contact           string         `json:"contact"`
	CurrencySymbol    string         `json:"currency_symbol"`
	StripeCustomerID  string         `json:"stripe_customer_id"`
	PaymentDetails    PaymentDetails `json:"payment_details"`
}
