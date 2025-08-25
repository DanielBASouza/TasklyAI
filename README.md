# 🚀 TasklyAI

A **Laravel** project that integrates **Twilio (WhatsApp)**, **OpenAI**, and **Stripe** to automate task scheduling via WhatsApp messages.

## 📌 Features

- 📲 Receive and send messages via WhatsApp (using Twilio).
- 🤖 Use *OpenAI* to interpret user commands and messages.
- 🗓️ Schedule tasks easily through WhatsApp conversations.
- 💳 Manage payments and subscriptions with **Stripe**.
- ⚡ Built on the powerful **Laravel** framework.

## 🛠️ Technologies

- **Laravel** – Modern and robust PHP backend.
- **Twilio** – WhatsApp integration.
- **OpenAI** – Artificial intelligence for message interpretation.
- **Stripe** – Online payments and subscriptions.

## 🚀 How to run the project

1. **Clone the repository**
   ```bash
   git clone https://github.com/DanielBASouza/TasklyAI.git
   cd tasklyai


2. **Install Laravel dependencies**
    ```bash
    composer install
    npm install && npm run dev

3. **Configure .env with your credentials**
    ```dotenv
    TWILIO_ACCOUNT_SID=
    TWILIO_AUTH_TOKEN=
    TWILIO_NEW_MESSAGE_URL=
    WHATS_APP_FROM=
    
    STRIPE_KEY=
    STRIPE_SECRET=
    STRIPE_WEBHOOK_SECRET=
    CASHIER_CURRENCY=
    
    OPENAI_TOKEN=


4. **Generate the application key**
    ```
    sail ./artisan key:generate


5. **Run the migrations**
    ```
    sail ./artisan migrate


6. **Start the server**
    ```
    sail up -d

# 📖 Example of use

Send a message on WhatsApp: "Schedule a meeting tomorrow at 3 PM"

The system interprets it with OpenAI and automatically registers the task.

If necessary, payment can be processed by Stripe.
